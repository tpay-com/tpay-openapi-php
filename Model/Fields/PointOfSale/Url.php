<?php

namespace tpaySDK\Model\Fields\PointOfSale;

use tpaySDK\Model\Fields\Field;

class Url extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 255;
    protected $pattern = 'https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&\/=]*)';
}
