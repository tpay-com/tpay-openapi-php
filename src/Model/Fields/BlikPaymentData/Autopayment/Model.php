<?php

namespace Tpay\OpenApi\Model\Fields\BlikPaymentData\Autopayment;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Model extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $enum = ['A', 'M', 'O'];
}