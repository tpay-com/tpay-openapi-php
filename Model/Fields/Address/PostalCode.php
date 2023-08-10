<?php

namespace tpaySDK\Model\Fields\Address;

use tpaySDK\Model\Fields\Field;

class PostalCode extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 10;
    protected $minLength = 1;
}
