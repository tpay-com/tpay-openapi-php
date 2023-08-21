<?php

namespace Tpay\Model\Fields\ApiCredentials;

use Tpay\Model\Fields\Field;

class Scope extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $enum = [
        'read',
        'write',
        'read write',
    ];
}
