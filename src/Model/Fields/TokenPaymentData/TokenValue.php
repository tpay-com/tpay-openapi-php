<?php

namespace Tpay\OpenApi\Model\Fields\TokenPaymentData;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class TokenValue extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $minLength = 12;
    protected $maxLength = 19;
}
