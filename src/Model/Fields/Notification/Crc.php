<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

class Crc extends Field
{
    protected $name = 'tr_crc';
    protected $type = self::STRING;
}
