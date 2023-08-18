<?php

namespace Tpay\Model\Fields\Person;

use Tpay\Model\Fields\Field;

class IssuingAuthority extends Field
{
    protected $type = self::STRING;
    protected $maxLength = 255;
    protected $name = __CLASS__;
}
