<?php

namespace tpaySDK\Model\Fields\Person;

use tpaySDK\Model\Fields\Field;

class Surname extends Field
{
    protected $type = self::STRING;
    protected $maxLength = 56;
    protected $name = __CLASS__;
}
