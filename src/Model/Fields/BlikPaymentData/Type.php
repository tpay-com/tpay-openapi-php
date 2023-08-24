<?php

namespace Tpay\OpenApi\Model\Fields\BlikPaymentData;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Type extends Field
{
    protected $name = __CLASS__;
    protected $type = self::INT;
    protected $enum = [0, 1];
}
