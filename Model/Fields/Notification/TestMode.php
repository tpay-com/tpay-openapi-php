<?php

namespace tpaySDK\Model\Fields\Notification;

use tpaySDK\Model\Fields\Field;

class TestMode extends Field
{
    protected $name = 'test_mode';
    protected $type = self::INT;
    protected $enum = [0, 1];
}
