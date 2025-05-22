<?php

namespace Tpay\OpenApi\Model\Fields\TokenPaymentData;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class CardExpiryDate extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $minLength = 4;
    protected $maxLength = 4;
    protected $pattern = '^[0-9]+$';
}
