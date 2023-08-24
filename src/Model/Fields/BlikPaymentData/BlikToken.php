<?php

namespace Tpay\OpenApi\Model\Fields\BlikPaymentData;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class BlikToken extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 6;
    protected $minLength = 6;
}
