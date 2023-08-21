<?php

namespace Tpay\Model\Fields\Recursive;

use Tpay\Model\Fields\Field;

class Type extends Field
{
    protected $name = __CLASS__;
    protected $type = self::INT;
    protected $enum = [1];
}
