<?php

namespace Tpay\Model\Fields\Address;

use Tpay\Model\Fields\Field;

class Name extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 128;
    protected $minLength = 1;
}
