<?php

namespace Tpay\OpenApi\Model\Fields\Recurring\PaymentInstrument;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class PaymentType extends Field
{
    const CARD_TOKEN = 'card_token';
    const BLIK_PAYID = 'blik_payid';
    const TEST = 'test';

    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $enum = [
        self::CARD_TOKEN,
        self::BLIK_PAYID,
        self::TEST,
    ];
}
