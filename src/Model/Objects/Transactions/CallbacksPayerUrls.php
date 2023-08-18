<?php

namespace Tpay\Model\Objects\Transactions;

use Tpay\Model\Fields\PointOfSale\Url;
use Tpay\Model\Objects\Objects;

class CallbacksPayerUrls extends Objects
{
    const OBJECT_FIELDS = [
        'success' => Url::class,
        'error' => Url::class,
    ];

    /**
     * @var Url
     */
    public $success;

    /**
     * @var Url
     */
    public $error;
}
