<?php

namespace Tpay\OpenApi\Model\Fields\Address;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class PostalCode extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 10;
    protected $minLength = 1;
}
