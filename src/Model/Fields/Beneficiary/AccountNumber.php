<?php

namespace Tpay\Model\Fields\Beneficiary;

use Tpay\Model\Fields\Field;

class AccountNumber extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 26;
    protected $minLength = 26;
    protected $pattern = '^[0-9]{26}$';
}
