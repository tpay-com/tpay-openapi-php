<?php

namespace Tpay\Model\Fields\Notification;

use Tpay\Model\Fields\Field;

class TransactionAmount extends Field
{
    protected $name = 'tr_amount';
    protected $type = self::NUMBER;
}
