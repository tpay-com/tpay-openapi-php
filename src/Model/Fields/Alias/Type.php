<?php

namespace Tpay\Model\Fields\Alias;

use Tpay\Model\Fields\Field;

class Type extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $enum = [
        'UID',
        'PAYID',
    ];
}
