<?php

namespace Tpay\Model\Fields\Notification;

use Tpay\Model\Fields\Field;

class TransactionId extends Field
{
    protected $name = 'tr_id';
    protected $type = self::STRING;
}
