<?php

namespace Tpay\Model\Fields\Account;

use Tpay\Model\Fields\Field;

class NotifyByEmail extends Field
{
    protected $name = __CLASS__;
    protected $type = self::BOOL;
    protected $value = true;
}
