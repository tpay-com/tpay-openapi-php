<?php

namespace Tpay\Model\Fields\Notification;

use Tpay\Model\Fields\Field;

class TestMode extends Field
{
    protected $name = 'test_mode';
    protected $type = self::INT;
    protected $enum = [0, 1];
}
