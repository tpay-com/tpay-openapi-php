<?php

namespace Tpay\OpenApi\Webhook;

use Tpay\OpenApi\Model\Objects\NotificationBody\BasicPayment;
use Tpay\OpenApi\Utilities\phpseclib\Crypt\RSA;
use Tpay\OpenApi\Utilities\phpseclib\File\X509;
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

    /**
     * @param string $merchantSecret string Merchant notification check secret
     * @param bool   $productionMode bool is prod or sandbox flag
     */
    public function __construct($merchantSecret, $productionMode = true)
    {
        $this->productionMode = $productionMode;
        $this->merchantSecret = $merchantSecret;
        parent::__construct();
    }

    /**
     * Get checked notification object.
     * If exception occurs it means that something went wrong with notification verification process.
     *
     * @throws TpayException
     *
     * @return BasicPayment
     */
    public function getNotification()
    {
        $notification = $this->getNotificationObject();
        $this->checkMd5($notification);
        $this->checkJwsSignature();

        return $notification;
    }

    protected function checkJwsSignature()
    {
        $jws = isset($_SERVER['HTTP_X_JWS_SIGNATURE']) ? $_SERVER['HTTP_X_JWS_SIGNATURE'] : null;
        if (null === $jws) {
            throw new TpayException('Missing JSW header');
        }

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

        $certificate = file_get_contents($x5u);
        $trusted = file_get_contents(sprintf("%s/x509/tpay-jws-root.pem", $this->getResourcePrefix()));

        if (empty($certificate) || empty($trusted)) {
            $certificate = $this->fallbackGetContents($x5u);
            $trusted = $this->fallbackGetContents(sprintf("%s/x509/tpay-jws-root.pem", $this->getResourcePrefix()));
        }

        $x509 = new X509();
        $x509->loadX509($certificate);
        $x509->loadCA($trusted);

        if (!$x509->validateSignature()) {
            throw new TpayException('Signing certificate is not signed by Tpay CA certificate');
        }

        $body = file_get_contents('php://input');
        $payload = str_replace('=', '', strtr(base64_encode($body), '+/', '-_'));
        $decodedSignature = base64_decode(strtr($signature, '-_', '+/'));
        $publicKey = $x509->getPublicKey();
        $publicKey = $x509->withSettings($publicKey, 'sha256', RSA::SIGNATURE_PKCS1);

        if (!$publicKey->verify($headers.'.'.$payload, $decodedSignature)) {
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

    /** @return BasicPayment */
    private function getNotificationObject()
    {
        if (!isset($_POST['tr_id'])) {
            throw new TpayException('Not recognised or invalid notification type. POST: '.json_encode($_POST));
        }
        $requestBody = new BasicPayment();
        foreach ($_POST as $parameter => $value) {
            if (isset($requestBody->{$parameter})) {
                $_POST[$parameter] = Util::cast($value, $requestBody->{$parameter}->getType());
            }
        }
        $this->Manager
            ->setRequestBody($requestBody)
            ->setFields($_POST, false);

        return $this->Manager->getRequestBody();
    }

    /**
     * @param string $url
     * @return bool|string
     * @throws TpayException
     */
    private function fallbackGetContents ($url) {
        if (!function_exists('curl_init')){
            throw TpayException::curlNotAvailable();
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
