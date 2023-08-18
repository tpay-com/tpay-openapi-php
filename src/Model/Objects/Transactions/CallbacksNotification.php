<?php

namespace Tpay\Model\Objects\Transactions;

use Tpay\Model\Fields\Person\Email;
use Tpay\Model\Fields\PointOfSale\Url;
use Tpay\Model\Objects\Objects;

class CallbacksNotification extends Objects
{
    const OBJECT_FIELDS = [
        'url' => Url::class,
        'email' => Email::class,
    ];

    /**
     * @var Url
     */
    public $url;

    /**
     * @var Email
     */
    public $email;
}
