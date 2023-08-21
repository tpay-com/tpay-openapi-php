<?php

namespace Tpay\Model\Fields\Transaction;

use Tpay\Model\Fields\Field;

class HiddenDescription extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 128;
}