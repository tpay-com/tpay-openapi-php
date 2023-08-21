<?php

namespace Tpay\OpenApi\Model\Fields\Address;

use Tpay\OpenApi\Model\Fields\Field;

class City extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 64;
    protected $minLength = 1;
}
