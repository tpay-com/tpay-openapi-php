<?php

namespace Tpay\Model\Fields\Person;

use Tpay\Model\Fields\Field;

class Surname extends Field
{
    protected $type = self::STRING;
    protected $maxLength = 56;
    protected $name = __CLASS__;
}
