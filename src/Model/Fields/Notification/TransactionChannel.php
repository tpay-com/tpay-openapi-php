<?php

namespace Tpay\Model\Fields\Notification;

use Tpay\Model\Fields\Field;

class TransactionChannel extends Field
{
    protected $name = 'tr_channel';
    protected $type = self::INT;
}
