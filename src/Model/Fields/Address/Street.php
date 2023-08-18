<?php

namespace Tpay\Model\Fields\Address;

use Tpay\Model\Fields\Field;

class Street extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 255;
    protected $minLength = 2;
}
