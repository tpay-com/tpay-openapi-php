<?php
namespace tpaySDK\Model\Fields\Notification;

use tpaySDK\Model\Fields\Field;

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
