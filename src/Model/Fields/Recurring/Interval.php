<?php

namespace Tpay\OpenApi\Model\Fields\Recurring;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): int
 */
class Interval extends Field
{
    protected $name = __CLASS__;
    protected $type = self::INT;
    protected $minimum = 1;
}
