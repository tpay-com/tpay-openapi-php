<?php

namespace Tpay\OpenApi\Model\Objects\Transactions;

use Tpay\OpenApi\Model\Fields\BlikPaymentData\BlikToken;
use Tpay\OpenApi\Model\Fields\BlikPaymentData\Type;
use Tpay\OpenApi\Model\Fields\Boolean;
use Tpay\OpenApi\Model\Objects\Objects;

class BlikPaymentData extends Objects
{
    const OBJECT_FIELDS = [
        'blikToken' => BlikToken::class,
        'aliases' => Alias::class,
        'type' => Type::class,
        'refuseNoPayId' => Boolean::class
    ];

    /** @var BlikToken */
    public $blikToken;

    /** @var Alias */
    public $aliases;

    /** @var Type */
    public $type;

    /** @var Boolean */
    public $refuseNoPayId;
}
