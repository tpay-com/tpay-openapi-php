<?php

namespace Tpay\OpenApi\Model\Fields\Person;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Pesel extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $pattern = '^[0-9]{11}$';
}
