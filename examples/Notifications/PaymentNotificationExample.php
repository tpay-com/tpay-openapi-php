<?php

namespace Tpay\Example\Notifications;

use Doctrine\Common\Cache\FilesystemCache;
use PSX\Cache\SimpleCache;
use Tpay\Example\ExamplesConfig;
use Tpay\OpenApi\Model\Objects\NotificationBody\BasicPayment;
use Tpay\OpenApi\Utilities\Cache;
use Tpay\OpenApi\Utilities\CacheCertificateProvider;
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
        $cache = new Cache(null, new SimpleCache(new FilesystemCache(__DIR__.'/cache/')));
        $provider = new CacheCertificateProvider($cache);
        $NotificationWebhook = new JWSVerifiedPaymentNotification($provider, self::MERCHANT_CONFIRMATION_CODE, $isProd);

        return $NotificationWebhook->getNotification();
    }
}

try {
    // if there is no exception - notification is checked and ready to use.
    $notification = (new PaymentNotificationExample())->getVerifiedNotification();
    if ($notification instanceof BasicPayment) {
        var_dump($notification->tr_id->getValue());
        // The above example will check the notification and print the value of received tr_id field
        // You can access any notification field by $notification->fieldName

        $notificationArray = $notification->getNotificationAssociative();
        var_dump($notificationArray);
        // The above method will get the notification as an associative array and print its contents.
        // You can access notification field value by $notificationArray['fieldName']
        exit('TRUE');
    }

    // Ignore and silence other notification types if not expected
    http_response_code(404);
    exit('FALSE');
} catch (TpayException $exception) {
    // handle your exception here
    exit('FALSE');
}
