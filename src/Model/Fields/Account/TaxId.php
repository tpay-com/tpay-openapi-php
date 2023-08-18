<?php

namespace Tpay\Model\Fields\Account;

use Tpay\Model\Fields\Field;

class TaxId extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 10;
    protected $minLength = 10;
}
