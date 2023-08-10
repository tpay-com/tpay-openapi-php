<?php

namespace tpaySDK\Model\Fields\Payer;

use tpaySDK\Model\Fields\Field;

class Address extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $minLength = 2;
    protected $maxLength = 255;
}
