<?php

namespace Tpay\Model\Fields\PersonContact;

use Tpay\Model\Fields\Field;

class Contact extends Field
{
    protected $type = self::STRING;
    protected $maxLength = 255;
    protected $name = __CLASS__;
}
