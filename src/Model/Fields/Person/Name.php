<?php

namespace Tpay\OpenApi\Model\Fields\Person;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Name extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 56;
    protected $minLength = 1;
}
