<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

class TransactionId extends Field
{
    protected $name = 'tr_id';
    protected $type = self::STRING;
}
