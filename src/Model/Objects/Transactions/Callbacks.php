<?php

namespace Tpay\OpenApi\Model\Objects\Transactions;

use Tpay\OpenApi\Model\Objects\Objects;

class Callbacks extends Objects
{
    const OBJECT_FIELDS = [
        'payerUrls' => CallbacksPayerUrls::class,
        'notification' => CallbacksNotification::class,
    ];

    /** @var CallbacksPayerUrls */
    public $payerUrls;

    /** @var CallbacksNotification */
    public $notification;
}
