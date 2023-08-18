<?php

namespace Tpay\Model\Fields\Person;

use Tpay\Model\Fields\Field;

class PepStatement extends Field
{
    protected $type = self::BOOL;
    protected $value = false;
    protected $name = __CLASS__;
}
