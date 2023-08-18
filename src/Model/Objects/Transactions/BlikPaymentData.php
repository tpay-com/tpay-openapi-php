<?php

namespace Tpay\Model\Objects\Transactions;

use Tpay\Model\Fields\BlikPaymentData\BlikToken;
use Tpay\Model\Fields\BlikPaymentData\Type;
use Tpay\Model\Objects\Objects;

class BlikPaymentData extends Objects
{
    const OBJECT_FIELDS = [
        'blikToken' => BlikToken::class,
        'aliases' => Alias::class,
        'type' => Type::class,
    ];

    /**
     * @var BlikToken
     */
    public $blikToken;

    /**
     * @var Alias
     */
    public $aliases;

    /**
     * @var Type
     */
    public $type;
}
