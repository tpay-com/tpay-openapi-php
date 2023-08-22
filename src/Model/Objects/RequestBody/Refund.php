<?php

namespace Tpay\OpenApi\Model\Objects\RequestBody;

use Tpay\OpenApi\Model\Fields\Transaction\Amount;
use Tpay\OpenApi\Model\Objects\Objects;

class Refund extends Objects
{
    const OBJECT_FIELDS = [
        'amount' => Amount::class,
    ];

    /** @var Amount */
    public $amount;
}
