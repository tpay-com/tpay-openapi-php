<?php

namespace Tpay\OpenApi\Model\Objects\Transactions;

use Tpay\OpenApi\Model\Fields\TokenPaymentData\CardBrand;
use Tpay\OpenApi\Model\Fields\TokenPaymentData\CardExpiryDate;
use Tpay\OpenApi\Model\Fields\TokenPaymentData\InitialTransactionId;
use Tpay\OpenApi\Model\Fields\TokenPaymentData\RocText;
use Tpay\OpenApi\Model\Fields\TokenPaymentData\TokenValue;
use Tpay\OpenApi\Model\Objects\Objects;

class TokenPaymentData extends Objects
{
    const OBJECT_FIELDS = [
        'tokenValue' => TokenValue::class,
        'cardExpiryDate' => CardExpiryDate::class,
        'initialTransactionId' => InitialTransactionId::class,
        'cardBrand' => CardBrand::class,
        'rocText' => RocText::class,
    ];

    /** @var TokenValue */
    public $tokenValue;

    /** @var CardExpiryDate */
    public $cardExpiryDate;

    /** @var InitialTransactionId */
    public $initialTransactionId;

    /** @var CardBrand */
    public $cardBrand;

    /** @var RocText */
    public $rocText;
}
