<?php

namespace tpaySDK\Model\Fields\Notification;

use tpaySDK\Model\Fields\Field;

class TransactionStatus extends Field
{
    protected $name = 'tr_status';
    protected $type = self::STRING;
    protected $enum = [
        'TRUE',
        'PAID',
        'CHARGEBACK',
    ];
}
