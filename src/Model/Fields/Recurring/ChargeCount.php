<?php

namespace Tpay\OpenApi\Model\Fields\Recurring;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): int
 */
class ChargeCount extends Field
{
    protected $name = __CLASS__;
    protected $type = self::INT;
}
