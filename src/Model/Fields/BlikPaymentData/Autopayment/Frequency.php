<?php

namespace Tpay\OpenApi\Model\Fields\BlikPaymentData\Autopayment;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Frequency extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $pattern = '^[0-9]+[DWMY]+$';
}
