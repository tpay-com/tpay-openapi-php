<?php

namespace Tpay\Model\Fields\Address;

use Tpay\Model\Fields\Field;

class FriendlyName extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 255;
}
