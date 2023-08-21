<?php

namespace Tpay\Model\Fields\Notification;

use Tpay\Model\Fields\Field;

class Masterpass extends Field
{
    protected $name = 'masterpass';
    protected $type = self::INT;
    protected $enum = [1];
}
