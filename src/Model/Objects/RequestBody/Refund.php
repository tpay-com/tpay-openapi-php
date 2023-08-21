<?php

namespace Tpay\Model\Objects\RequestBody;

use Tpay\Model\Fields\Transaction\Amount;
use Tpay\Model\Objects\Objects;

class Refund extends Objects
{
    const OBJECT_FIELDS = [
        'amount' => Amount::class,
    ];

    /**
     * @var Amount
     */
    public $amount;
}
