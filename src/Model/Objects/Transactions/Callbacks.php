<?php

namespace Tpay\Model\Objects\Transactions;

use Tpay\Model\Objects\Objects;

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
