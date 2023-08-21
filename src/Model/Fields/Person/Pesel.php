<?php

namespace Tpay\Model\Fields\Person;

use Tpay\Model\Fields\Field;

class Pesel extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $pattern = '^[0-9]{11}$';
}
