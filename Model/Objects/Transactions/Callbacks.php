<?php
namespace tpaySDK\Model\Objects\Transactions;

use tpaySDK\Model\Objects\Objects;

class Callbacks extends Objects
{
    const OBJECT_FIELDS = [
        'payerUrls' => CallbacksPayerUrls::class,
        'notification' => CallbacksNotification::class,
    ];

    /**
     * @var CallbacksPayerUrls
     */
    public $payerUrls;

    /**
     * @var CallbacksNotification
     */
    public $notification;

}
