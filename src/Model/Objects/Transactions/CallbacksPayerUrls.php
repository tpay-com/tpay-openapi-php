<?php

namespace Tpay\OpenApi\Model\Objects\Transactions;

use Tpay\OpenApi\Model\Fields\PointOfSale\Url;
use Tpay\OpenApi\Model\Objects\Objects;

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
