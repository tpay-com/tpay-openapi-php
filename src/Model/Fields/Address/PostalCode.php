<?php

namespace Tpay\Model\Fields\Address;

use Tpay\Model\Fields\Field;

class PostalCode extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 10;
    protected $minLength = 1;
}
