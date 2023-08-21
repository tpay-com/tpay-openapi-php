<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

class Masterpass extends Field
{
    protected $name = 'masterpass';
    protected $type = self::INT;
    protected $enum = [1];
}
