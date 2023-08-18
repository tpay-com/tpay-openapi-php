<?php

namespace Tpay\Model\Fields\Account;

use Tpay\Model\Fields\Field;

class Regon extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 14;
    protected $minLength = 9;
}
