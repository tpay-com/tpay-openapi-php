<?php

namespace Tpay\OpenApi\Model\Fields\Address;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Street extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 255;
    protected $minLength = 2;
}
