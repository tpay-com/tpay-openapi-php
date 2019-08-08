<?php
namespace tpaySDK\Model\Fields\Notification;

use tpaySDK\Model\Fields\Field;

class TestMode extends Field
{
    protected $name = __CLASS__;

    protected $type = self::INT;

    protected $enum = [0, 1];

}
