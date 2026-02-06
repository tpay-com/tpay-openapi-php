<?php

namespace Tpay\OpenApi\Webhook;

use Tpay\OpenApi\Model\Objects\NotificationBody\BasicPayment;
use Tpay\OpenApi\Model\Objects\NotificationBody\BlikAliasRegister;
use Tpay\OpenApi\Model\Objects\NotificationBody\BlikAliasUnregister;
use Tpay\OpenApi\Model\Objects\NotificationBody\MarketplaceTransaction;
use Tpay\OpenApi\Model\Objects\NotificationBody\Tokenization;
use Tpay\OpenApi\Model\Objects\NotificationBody\TokenUpdate;
use Tpay\OpenApi\Model\Objects\Objects;
use Tpay\OpenApi\Utilities\CacheCertificateProvider;
use Tpay\OpenApi\Utilities\CertificateProvider;
use Tpay\OpenApi\Utilities\phpseclib\Crypt\RSA;
use Tpay\OpenApi\Utilities\RequestParser;
use Tpay\OpenApi\Utilities\TpayException;
use Tpay\OpenApi\Utilities\Util;

class JWSVerifiedPaymentNotification extends Notification
{
    const PRODUCTION_PREFIX = 'https://secure.tpay.com';
    const SANDBOX_PREFIX = 'https://secure.sandbox.tpay.com';

    /** @var bool */
    private $productionMode;

    /** @var string */
    private $merchantSecret;

    /** @var RequestParser */
    private $requestParser;

    /** @var CertificateProvider */
    private $certificateProvider;

    /**
     * @param string $merchantSecret string Merchant notification check secret
     * @param bool   $productionMode true for prod or false for sandbox environment
     */
    public function __construct(
        CertificateProvider $certificateProvider,
        string $merchantSecret,
        ?bool $productionMode = true,
        ?RequestParser $requestParser = null
    ) {
        $this->productionMode = $productionMode;
        $this->merchantSecret = $merchantSecret;
        $this->requestParser = null === $requestParser ? new RequestParser() : $requestParser;
        $this->certificateProvider = $certificateProvider;
        parent::__construct();
    }

    /**
     * Get checked notification object.
     * If exception occurs it means that something went wrong with notification verification process.
     *
     * @throws TpayException
     *
     * @return BasicPayment|MarketplaceTransaction|Objects|Tokenization|TokenUpdate
     */
    public function getNotification()
    {
        $notification = $this->getNotificationObject();
        if ($notification instanceof BasicPayment) {
            $this->checkMd5($notification);
        }
        $this->checkJwsSignature();

        return $notification;
    }

    protected function checkJwsSignature()
    {
        $jws = $this->requestParser->getSignature();

        $jwsData = explode('.', $jws);
        $headers = isset($jwsData[0]) ? $jwsData[0] : null;
        $signature = isset($jwsData[2]) ? $jwsData[2] : null;
        if (null === $headers || null === $signature) {
            throw new TpayException('Invalid JWS header');
        }

        $headersJson = base64_decode(strtr($headers, '-_', '+/'));

        /** @var array $headersData */
        $headersData = json_decode($headersJson, true);

        /** @var null|string $x5u */
        $x5u = isset($headersData['x5u']) ? $headersData['x5u'] : null;

        if (null === $x5u) {
            throw new TpayException('Missing x5u header');
        }

        $prefix = $this->getResourcePrefix();

        if (substr($x5u, 0, strlen($prefix)) !== $prefix) {
            throw new TpayException('Wrong x5u url');
        }

        $rootCa = sprintf('%s/x509/tpay-jws-root.pem', $prefix);
        $x509 = $this->certificateProvider->provide($x5u, $rootCa);

        $body = $this->requestParser->getPayload();
        $payload = str_replace('=', '', strtr(base64_encode($body), '+/', '-_'));
        $decodedSignature = base64_decode(strtr($signature, '-_', '+/'));
        $publicKey = $x509->getPublicKey();
        $publicKey = $x509->withSettings($publicKey, 'sha256', RSA::SIGNATURE_PKCS1);

        if (!$publicKey->verify($headers.'.'.$payload, $decodedSignature)) {
            if ($this->certificateProvider instanceof CacheCertificateProvider) {
                $this->certificateProvider->clearCachedCerts($x5u, $rootCa);
            }
            throw new TpayException('FALSE - Invalid JWS signature');
        }
    }

    /**
     * @param int    $id
     * @param string $transactionId
     * @param string $amount
     * @param string $orderId
     * @param string $merchantSecret
     * @param string $requestMd5
     *
     * @throws TpayException
     */
    private function checkMd5Validity($id, $transactionId, $amount, $orderId, $merchantSecret, $requestMd5)
    {
        if (md5($id.$transactionId.$amount.$orderId.$merchantSecret) !== $requestMd5) {
            throw new TpayException('MD5 checksum is invalid');
        }
    }

    /**
     * @param BasicPayment $notification
     *
     * @throws TpayException
     */
    private function checkMd5($notification)
    {
        $this->checkMd5Validity(
            $notification->id->getValue(),
            $notification->tr_id->getValue(),
            Util::numberFormat($notification->tr_amount->getValue()),
            $notification->tr_crc->getValue(),
            $this->merchantSecret,
            $notification->md5sum->getValue()
        );
    }

    /** @return string */
    private function getResourcePrefix()
    {
        if ($this->productionMode) {
            return self::PRODUCTION_PREFIX;
        }

        return self::SANDBOX_PREFIX;
    }

    /**
     * @throws TpayException
     *
     * @return BasicPayment|MarketplaceTransaction|Objects|Tokenization|TokenUpdate
     */
    private function getNotificationObject()
    {
        $source = $this->requestParser->getParsedContent();

        if (isset($source['tr_id'])) {
            $requestBody = new BasicPayment();
        } elseif (isset($source['type'])) {
            switch ($source['type']) {
                case 'tokenization':
                    $requestBody = new Tokenization();
                    break;
                case 'token_update':
                    $requestBody = new TokenUpdate();
                    break;
                case 'marketplace_transaction':
                    $requestBody = new MarketplaceTransaction();
                    break;
                case 'ALIAS_REGISTER':
                    $requestBody = new BlikAliasRegister();
                    break;
                case 'ALIAS_UNREGISTER':
                    $requestBody = new BlikAliasUnregister();
                    break;
                default:
                    throw new TpayException(
                        'Not recognised or invalid notification type: '.$source['type']
                    );
            }

            $source = $this->getSourceData($source);
        } else {
            throw new TpayException(
                'Cannot determine notification type. POST payload: '.json_encode($source)
            );
        }

        foreach ($source as $parameter => $value) {
            if (isset($requestBody->{$parameter})) {
                $source[$parameter] = Util::cast(
                    $value,
                    $requestBody->{$parameter}->getType()
                );
            }
        }

        $this->Manager
            ->setRequestBody($requestBody)
            ->setFields($source, false);

        return $this->Manager->getRequestBody();
    }

    /** @return array
     * @throws TpayException
     */
    private function getSourceData($sourceData)
    {
        if (isset($sourceData['data'])) {
            return $sourceData['data'];
        }
        if (isset($sourceData['msg_value'])) {
            return $sourceData['msg_value'];
        }

        throw new TpayException('Not recognised or invalid notification type: '.json_encode($sourceData));
    }
}
