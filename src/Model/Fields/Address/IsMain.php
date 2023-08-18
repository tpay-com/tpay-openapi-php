<?php

namespace Tpay\Model\Fields\Address;

use Tpay\Model\Fields\Field;

class IsMain extends Field
{
    protected $name = __CLASS__;
    protected $type = self::BOOL;
    protected $value = true;
}
