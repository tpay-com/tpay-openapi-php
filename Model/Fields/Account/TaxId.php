<?php

namespace tpaySDK\Model\Fields\Account;

use tpaySDK\Model\Fields\Field;

class TaxId extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 10;
    protected $minLength = 10;
}
