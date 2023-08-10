<?php

namespace tpaySDK\Model\Fields\Transaction;

use tpaySDK\Model\Fields\Field;

class Country extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 2;
    protected $minLength = 2;
}
