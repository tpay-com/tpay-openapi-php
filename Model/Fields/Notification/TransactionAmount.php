<?php

namespace tpaySDK\Model\Fields\Notification;

use tpaySDK\Model\Fields\Field;

class TransactionAmount extends Field
{
    protected $name = 'tr_amount';
    protected $type = self::NUMBER;
}
