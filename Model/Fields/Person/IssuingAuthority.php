<?php

namespace tpaySDK\Model\Fields\Person;

use tpaySDK\Model\Fields\Field;

class IssuingAuthority extends Field
{
    protected $type = self::STRING;
    protected $maxLength = 255;
    protected $name = __CLASS__;
}
