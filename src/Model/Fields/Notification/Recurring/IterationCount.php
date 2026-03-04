<?php

namespace Tpay\OpenApi\Model\Fields\Notification\Recurring;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class IterationCount extends Field
{
    protected $name = __CLASS__;
    protected $type = self::INT;
}
