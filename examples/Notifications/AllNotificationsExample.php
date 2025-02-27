<?php

namespace Tpay\Example\Notifications;

use Tpay\Example\ExamplesConfig;
use Tpay\OpenApi\Model\Objects\NotificationBody\BasicPayment;
use Tpay\OpenApi\Model\Objects\NotificationBody\MarketplaceTransaction;
use Tpay\OpenApi\Model\Objects\NotificationBody\Tokenization;
use Tpay\OpenApi\Model\Objects\NotificationBody\TokenUpdate;
use Tpay\OpenApi\Model\Objects\Objects;
use Tpay\OpenApi\Utilities\TpayException;
use Tpay\OpenApi\Webhook\JWSVerifiedPaymentNotification;

final class AllNotificationsExample extends ExamplesConfig
{
    /**
     * Returns validated object with set parameters
     *
     * @return Objects
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
    $notification = (new AllNotificationsExample())->getVerifiedNotification();
    if ($notification instanceof BasicPayment) {
        // Notification about successful payment

        $transactionId = $notification->tr_id->getValue();
        // The above example will check the notification and return the value of received tr_id field
        // You can access any notification field by $notification->fieldName

        $notificationArray = $notification->getNotificationAssociative();
        // The above method will get the notification as an associative array.
        // You can access notification field value by $notificationArray['fieldName']

        // $successfulPaymentProcessor->process($notification)
        exit('TRUE');
    }
    if ($notification instanceof Tokenization) {
        // Notification about successful card tokenization

        $transactionId = $notification->token->getValue();
        // The above example will check the notification and return the value of received token field
        // You can access any notification field by $notification->fieldName

        // $tokenizationProcessor->process($notification)
        exit('{"result":true}');
    }
    if ($notification instanceof TokenUpdate) {
        // Notification about card token update

        $transactionId = $notification->token->getValue();
        // The above example will check the notification and return the value of received token field
        // You can access any notification field by $notification->fieldName

        // $tokenUpdateProcessor->process($notification)
        exit('{"result":true}');
    }
    if ($notification instanceof MarketplaceTransaction) {
        // Notification about successful marketplace payment

        $transactionId = $notification->transactionId->getValue();
        // The above example will check the notification and return the value of received transactionId field
        // You can access any notification field by $notification->fieldName

        // $marketplaceTransactionProcessor->process($notification)
        exit('{"result":true}');
    }

    // Ignore and silence other notification types if not expected
    http_response_code(404);
    exit('FALSE');
} catch (TpayException $exception) {
    // handle your exception here
    exit('FALSE');
}
