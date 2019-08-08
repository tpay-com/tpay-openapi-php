<?php
namespace tpaySDK\Model\Fields\Pay;

use tpaySDK\Model\Fields\Field;

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
