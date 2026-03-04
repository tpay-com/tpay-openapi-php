<?php

namespace Tpay\OpenApi\Model\Fields\Recurring;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Id extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 26;
    protected $minLength = 26;
}
