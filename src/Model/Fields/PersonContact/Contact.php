<?php

namespace Tpay\OpenApi\Model\Fields\PersonContact;

use Tpay\OpenApi\Model\Fields\Field;

class Contact extends Field
{
    protected $type = self::STRING;
    protected $maxLength = 255;
    protected $name = __CLASS__;
}
