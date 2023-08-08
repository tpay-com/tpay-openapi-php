<?php

namespace tpaySDK\Model\Fields\Address;

use tpaySDK\Model\Fields\Field;

class FriendlyName extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 255;
}
