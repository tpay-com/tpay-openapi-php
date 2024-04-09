<?php

namespace Tpay\Example\Notifications;

use Tpay\Example\ExamplesConfig;
use Tpay\OpenApi\Model\Objects\NotificationBody\BasicPayment;
use Tpay\OpenApi\Utilities\TpayException;
use Tpay\OpenApi\Webhook\JWSVerifiedPaymentNotification;

final class PaymentNotificationExample extends ExamplesConfig
{
    /**
     * Returns validated object with set parameters
     *
     * @return BasicPayment
     */
    public function getVerifiedNotification()
    {
        // if isProd == false -> use sandbox credentials.
        $isProd = true;
        $NotificationWebhook = new JWSVerifiedPaymentNotification(self::MERCHANT_CONFIRMATION_CODE, $isProd);

        return $NotificationWebhook->getNotification();
    }
}

try {
    // if there is no exception - notification is checked and ready to use.
    $notification = (new PaymentNotificationExample())->getVerifiedNotification();
    var_dump($notification->tr_id->getValue());
    // The above example will check the notification and print the value of received tr_id field
    // You can access any notification field by $notification->fieldName

    $notificationArray = $notification->getNotificationAssociative();
    var_dump($notificationArray);
    // The above method will get the notification as an associative array and print its contents.
    // You can access notification field value by $notificationArray['fieldName']
    exit('TRUE');
} catch (TpayException $exception) {
    // handle your exception here
    exit('FALSE');
}
