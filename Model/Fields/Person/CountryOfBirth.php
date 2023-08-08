<?php

namespace tpaySDK\Model\Fields\Person;

use tpaySDK\Model\Fields\Field;

class CountryOfBirth extends Field
{
    protected $type = self::STRING;
    protected $maxLength = 2;
    protected $name = __CLASS__;
}
