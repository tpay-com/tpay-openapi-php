<?php
namespace tpaySDK\Examples\Notifications;

use tpaySDK\Examples\ExamplesConfig;
use tpaySDK\Model\Objects\NotificationBody\BasicPayment;
use tpaySDK\Webhook\PaymentNotification;

require_once '../ExamplesConfig.php';
require_once '../../Loader.php';

class PaymentNotificationExample extends ExamplesConfig
{
    /**
     * Returns validated object with set parameters
     * @return BasicPayment
     */
    public function checkPayment()
    {
        $NotificationWebhook = new PaymentNotification;

        return $NotificationWebhook->getNotification('TRUE', static::MERCHANT_CONFIRMATION_CODE);
    }

}
$notification = (new PaymentNotificationExample)->checkPayment();
var_dump($notification->tr_id->getValue());
//The above example will check the notification and print the value of received tr_id field
//You can access any notification field by $notification->fieldName

$notificationArray = $notification->getNotificationAssociative();
var_dump($notificationArray);
//The above method will get the notification as an associative array and print its contents.
//You can access notification field value by $notificationArray['fieldName']
