<?php

namespace Tpay\Model\Fields\Address;

use Tpay\Model\Fields\Field;

class HouseNumber extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 10;
}
