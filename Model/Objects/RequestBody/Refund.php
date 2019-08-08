<?php
namespace tpaySDK\Model\Objects\RequestBody;

use tpaySDK\Model\Fields\Transaction\Amount;
use tpaySDK\Model\Objects\ObjectHelper;
use tpaySDK\Model\Objects\Objects;

class Refund extends Objects
{
    use ObjectHelper;

    const OBJECT_FIELDS = [
        'amount' => Amount::class,
    ];

    /**
     * @var Amount
     */
    public $amount;

}
