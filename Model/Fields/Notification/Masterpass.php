<?php
namespace tpaySDK\Model\Fields\Notification;

use tpaySDK\Model\Fields\Field;

class Masterpass extends Field
{
    protected $name = 'masterpass';

    protected $type = self::INT;

    protected $enum = [1];

}
