<?php

namespace Tpay\Model\Fields\Address;

use Tpay\Model\Fields\Field;

class Description extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 255;
}
