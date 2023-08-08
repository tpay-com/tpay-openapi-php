<?php

namespace tpaySDK\Model\Objects\Transactions;

use tpaySDK\Model\Fields\PointOfSale\Url;
use tpaySDK\Model\Objects\Objects;

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
