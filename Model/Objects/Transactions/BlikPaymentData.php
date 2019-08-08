<?php
namespace tpaySDK\Model\Objects\Transactions;

use tpaySDK\Model\Fields\BlikPaymentData\BlikToken;
use tpaySDK\Model\Fields\BlikPaymentData\Type;
use tpaySDK\Model\Objects\Objects;

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
