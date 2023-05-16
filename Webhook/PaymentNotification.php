<?php
namespace tpaySDK\Webhook;

use tpaySDK\Model\Objects\NotificationBody\BasicPayment;
use tpaySDK\Utilities\Logger;
use tpaySDK\Utilities\TpayException;
use tpaySDK\Utilities\Util;

class PaymentNotification extends Notification
{
    /**
     * Check cURL request from Tpay server after payment.
     * This method check server ip, required fields and checksum sent by payment server.
     * Display information to prevent sending repeated notifications.
     * @param string $response Print response to Tpay server.
     * If empty, then you have to print it somewhere else to avoid rescheduling notifications
     * @param string $merchantSecret
     * @return BasicPayment
     * @throws TpayException
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
        Logger::logLine('Check MD5: '.(int)$checkMD5);
        if ($checkMD5 === false) {
            throw new TpayException('MD5 checksum is invalid');
        }

        return $notification;
    }

    protected function getRequestBody()
    {
        if (isset($_POST['tr_id'])) {
            return new BasicPayment();
        }
        throw new TpayException('Not recognised or invalid notification type. POST: '.json_encode($_POST));
    }

    private function isMd5Valid($id, $transactionId, $amount, $orderId, $merchantSecret, $requestMd5)
    {
        return md5($id.$transactionId.$amount.$orderId.$merchantSecret) === $requestMd5;
    }

}
