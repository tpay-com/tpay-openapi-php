<?php

namespace Tpay\OpenApi\Model\Fields\Account;

use Tpay\OpenApi\Model\Fields\Field;

class NotifyByEmail extends Field
{
    protected $name = __CLASS__;
    protected $type = self::BOOL;
    protected $value = true;
}
