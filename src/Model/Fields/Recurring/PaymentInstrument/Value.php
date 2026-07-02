<?php

namespace Tpay\OpenApi\Model\Fields\Recurring\PaymentInstrument;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Value extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
}
