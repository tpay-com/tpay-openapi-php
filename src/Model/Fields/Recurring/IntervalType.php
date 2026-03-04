<?php

namespace Tpay\OpenApi\Model\Fields\Recurring;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class IntervalType extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $enum = ['days', 'months'];
}
