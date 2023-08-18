<?php

namespace Tpay\Model\Fields\Person;

use Tpay\Model\Fields\Field;

class Name extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 56;
    protected $minLength = 1;
}
