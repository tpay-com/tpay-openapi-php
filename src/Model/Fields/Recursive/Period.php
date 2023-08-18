<?php

namespace Tpay\Model\Fields\Recursive;

use Tpay\Model\Fields\Field;

class Period extends Field
{
    protected $name = __CLASS__;
    protected $type = self::INT;
    protected $enum = [1, 2, 3, 4, 5];
}
