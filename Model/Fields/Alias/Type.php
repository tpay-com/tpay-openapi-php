<?php

namespace tpaySDK\Model\Fields\Alias;

use tpaySDK\Model\Fields\Field;

class Type extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $enum = [
        'UID',
        'PAYID',
    ];
}
