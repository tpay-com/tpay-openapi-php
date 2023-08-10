<?php

namespace tpaySDK\Model\Fields\Person;

use tpaySDK\Model\Fields\Field;

class Pesel extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $pattern = '^[0-9]{11}$';
}
