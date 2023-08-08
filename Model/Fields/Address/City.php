<?php

namespace tpaySDK\Model\Fields\Address;

use tpaySDK\Model\Fields\Field;

class City extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 64;
    protected $minLength = 1;
}
