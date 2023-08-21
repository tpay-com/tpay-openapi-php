<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

class Error extends Field
{
    protected $name = 'tr_error';
    protected $type = self::STRING;
    protected $enum = [
        'none',
        'overpay',
        'surcharge',
    ];
}
