<?php

namespace Tpay\OpenApi\Model\Fields\Pay;

use Tpay\OpenApi\Model\Fields\Field;

class Method extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $enum = [
        'pay_by_link',
        'transfer',
        'sale',
    ];
}
