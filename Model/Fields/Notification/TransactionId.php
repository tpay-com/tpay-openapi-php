<?php

namespace tpaySDK\Model\Fields\Notification;

use tpaySDK\Model\Fields\Field;

class TransactionId extends Field
{
    protected $name = 'tr_id';
    protected $type = self::STRING;
}
