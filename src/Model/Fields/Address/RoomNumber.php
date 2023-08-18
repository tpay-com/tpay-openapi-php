<?php

namespace Tpay\Model\Fields\Address;

use Tpay\Model\Fields\Field;

class RoomNumber extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 10;
}
