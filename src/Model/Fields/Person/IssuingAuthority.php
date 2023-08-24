<?php

namespace Tpay\OpenApi\Model\Fields\Person;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class IssuingAuthority extends Field
{
    protected $type = self::STRING;
    protected $maxLength = 255;
    protected $name = __CLASS__;
}
