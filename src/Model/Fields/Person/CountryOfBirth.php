<?php

namespace Tpay\OpenApi\Model\Fields\Person;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class CountryOfBirth extends Field
{
    protected $type = self::STRING;
    protected $maxLength = 2;
    protected $name = __CLASS__;
}
