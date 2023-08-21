<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

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
