<?php

namespace tpaySDK\Webhook;

use phpseclib3\Crypt\RSA;
use phpseclib3\File\X509;
use tpaySDK\Model\Objects\NotificationBody\BasicPayment;
use tpaySDK\Utilities\Logger;
use tpaySDK\Utilities\TpayException;
use tpaySDK\Utilities\Util;

class JWSVerifiedPaymentNotification extends Notification
{
    const PRODUCTION_PREFIX = 'https://secure.tpay.com';
    const SANDBOX_PREFIX = 'https://secure.sandbox.tpay.com';

    private $productionMode;
    private $merchantSecret;

    /**
     * @param $merchantSecret string Merchant notification check secret
     * @param $productionMode bool is prod or sandbox flag
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
     * @return BasicPayment
     * @throws TpayException
     */
    public function getNotification()
    {
        $notification = $this->getNotificationObject();
        /** @var BasicPayment $notification */
        $this->checkMd5($notification);
        $this->checkJwsSignature();

        return $notification;
    }

    private function checkMd5Validity($id, $transactionId, $amount, $orderId, $merchantSecret, $requestMd5)
    {
        if (md5($id . $transactionId . $amount . $orderId . $merchantSecret) !== $requestMd5) {
            throw new TpayException('MD5 checksum is invalid');
        }
    }

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

        $headersData = json_decode($headersJson, true);
        $x5u = isset($headersData['x5u']) ? $headersData['x5u'] : null;
        if (null === $x5u) {
            throw new TpayException('Missing x5u header');
        }

        $prefix = $this->getResourcePrefix();
        if (substr($x5u, 0, strlen($prefix)) !== $prefix) {
            throw new TpayException('Wrong x5u url');
        }

        $certificate = file_get_contents($x5u);
        $trusted = file_get_contents($this->getResourcePrefix() . '/x509/tpay-jws-root.pem');

        $x509 = new X509();
        $x509->loadX509($certificate);
        $x509->loadCA($trusted);
        if (!$x509->validateSignature()) {
            throw new TpayException('Signing certificate is not signed by Tpay CA certificate');
        }

        $body = file_get_contents('php://input');
        $payload = str_replace('=', '', strtr(base64_encode($body), '+/', '-_'));
        $decodedSignature = base64_decode(strtr($signature, '-_', '+/'));

        $publicKey = $x509->getPublicKey()
            ->withHash('sha256')
            ->withPadding(RSA::SIGNATURE_PKCS1);
        if (!$publicKey->verify($headers . '.' . $payload, $decodedSignature)) {
            throw new TpayException('FALSE - Invalid JWS signature');
        }
    }

    private function getResourcePrefix()
    {
        if ($this->productionMode) {

            return self::PRODUCTION_PREFIX;
        }

        return self::SANDBOX_PREFIX;
    }

    private function getNotificationObject()
    {
        if (!isset($_POST['tr_id'])) {
            throw new TpayException('Not recognised or invalid notification type. POST: ' . json_encode($_POST));
        }
        $requestBody = new BasicPayment();
        foreach ($_POST as $parameter => $value) {
            if (isset($requestBody->$parameter)) {
                $_POST[$parameter] = Util::cast($value, $requestBody->$parameter->getType());
            }
        }
        $this->Manager
            ->setRequestBody($requestBody)
            ->setFields($_POST, false);

        return $this->Manager->getRequestBody();
    }
}
