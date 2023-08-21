<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

class TestMode extends Field
{
    protected $name = 'test_mode';
    protected $type = self::INT;
    protected $enum = [0, 1];
}
