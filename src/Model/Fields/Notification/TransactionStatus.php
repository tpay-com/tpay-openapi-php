<?php

namespace Tpay\Model\Fields\Notification;

use Tpay\Model\Fields\Field;

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
