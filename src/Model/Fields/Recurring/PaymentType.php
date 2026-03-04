<?php

namespace Tpay\OpenApi\Model\Fields\Recurring;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class PaymentType extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $enum = ['card_token'];
}
