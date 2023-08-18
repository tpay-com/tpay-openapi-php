<?php

namespace Tpay\Model\Fields\Address;

use Tpay\Model\Fields\Field;

class Phone extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 30;
}
