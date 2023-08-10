<?php

namespace tpaySDK\Model\Fields\Notification;

use tpaySDK\Model\Fields\Field;

class Md5sum extends Field
{
    protected $name = 'md5sum';
    protected $type = self::STRING;
    protected $minLength = 32;
    protected $maxLength = 32;
}
