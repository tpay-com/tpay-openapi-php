<?php

namespace Tpay\OpenApi\Webhook;

use Tpay\OpenApi\Dictionary\NotificationsIP;
use Tpay\OpenApi\Model\Objects\NotificationBody\BasicPayment;
use Tpay\OpenApi\Model\Objects\Objects;
use Tpay\OpenApi\Utilities\Logger;
use Tpay\OpenApi\Utilities\ServerValidator;
use Tpay\OpenApi\Utilities\TpayException;
use Tpay\OpenApi\Utilities\Util;

/**
 * @deprecated use JWSVerifiedPaymentNotification::class instead
 */
class PaymentNotification extends Notification
{
    /** @var BasicPayment */
    public $requestBody;

    /** @var array<string> */
    protected $secureIP = NotificationsIP::SECURE_IPS;

    /** @var bool */
    protected $validateServerIP = true;

    /** @var bool */
    protected $validateForwardedIP = false;

    /**
     * Check cURL request from Tpay server after payment.
     * This method check server ip, required fields and checksum sent by payment server.
     * Display information to prevent sending repeated notifications.
     *
     * @param string $response       Print response to Tpay server.
     *                               If empty, then you have to print it somewhere else to avoid rescheduling notifications
     * @param string $merchantSecret
     *
     * @throws TpayException
     *
     * @return BasicPayment
     */
    public function getNotification($response = 'TRUE', $merchantSecret = '')
    {
        $this->requestBody = $this->getRequestBody();

        /** @var BasicPayment $notification */
        $notification = $this->checkNotification($response);

        $checkMD5 = $this->isMd5Valid(
            $notification->id->getValue(),
            $notification->tr_id->getValue(),
            Util::numberFormat($notification->tr_amount->getValue()),
            $notification->tr_crc->getValue(),
            $merchantSecret,
            $notification->md5sum->getValue()
        );
        Logger::logLine('Check MD5: '.(int) $checkMD5);
        if (false === $checkMD5) {
            throw new TpayException('MD5 checksum is invalid');
        }

        return $notification;
    }

    /**
     * Validation of Tpay server ip is mandatory in production mode.
     *
     * @param bool $validateServerIP
     *
     * @return Notification
     */
    public function setValidateServerIP($validateServerIP)
    {
        $this->validateServerIP = $validateServerIP;

        return $this;
    }

    /**
     * Set validation of Tpay server IP in forwarded IP table - enabling this is not recommended due to security risk
     *
     * @param bool $validateForwardedIP
     *
     * @return Notification
     */
    public function setValidateForwardedIP($validateForwardedIP)
    {
        $this->validateForwardedIP = $validateForwardedIP;

        return $this;
    }

    /**
     * Check cURL request from Tpay server after payment.
     * This method check server ip, required fields and checksum sent by payment server.
     * Display information to prevent sending repeated notifications.
     *
     * @param string $response Print response to Tpay server.
     *                         If empty, then you have to print it somewhere else to avoid rescheduling notifications
     *
     * @throws TpayException
     *
     * @return Objects
     */
    public function checkNotification($response = '')
    {
        if (true === $this->validateServerIP && false === $this->isTpayServer()) {
            throw new TpayException('Request is not from secure server');
        }
        $requestBody = $this->requestBody;
        Logger::log('Notification', 'POST params:'.PHP_EOL.json_encode($_POST));
        foreach ($_POST as $parameter => $value) {
            if (isset($requestBody->{$parameter})) {
                $_POST[$parameter] = Util::cast($value, $requestBody->{$parameter}->getType());
            }
        }
        $this->Manager
            ->setRequestBody($requestBody)
            ->setFields($_POST, false);
        $notification = $this->Manager->getRequestBody();
        if (is_string($response) && strlen($response) > 0) {
            echo $response;
        }

        return $notification;
    }

    /** @return BasicPayment */
    protected function getRequestBody()
    {
        if (isset($_POST['tr_id'])) {
            return new BasicPayment();
        }
        throw new TpayException('Not recognised or invalid notification type. POST: '.json_encode($_POST));
    }

    /** @return bool */
    protected function isTpayServer()
    {
        return (new ServerValidator($this->validateServerIP, $this->validateForwardedIP, $this->secureIP))->isValid();
    }

    /**
     * @param int    $id
     * @param string $transactionId
     * @param string $amount
     * @param string $orderId
     * @param string $merchantSecret
     * @param string $requestMd5
     *
     * @return bool
     */
    private function isMd5Valid($id, $transactionId, $amount, $orderId, $merchantSecret, $requestMd5)
    {
        return md5($id.$transactionId.$amount.$orderId.$merchantSecret) === $requestMd5;
    }
}
