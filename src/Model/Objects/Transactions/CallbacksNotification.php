<?php

namespace Tpay\OpenApi\Model\Objects\Transactions;

use Tpay\OpenApi\Model\Fields\Person\Email;
use Tpay\OpenApi\Model\Fields\PointOfSale\Url;
use Tpay\OpenApi\Model\Objects\Objects;

class CallbacksNotification extends Objects
{
    public const OBJECT_FIELDS = [
        'url' => Url::class,
        'email' => Email::class,
    ];

    /** @var Url */
    public $url;

    /** @var Email */
    public $email;
}
