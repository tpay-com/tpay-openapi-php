<?php

namespace Tpay\Model\Fields\Payer;

use Tpay\Model\Fields\Field;

class Address extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $minLength = 2;
    protected $maxLength = 255;
}
