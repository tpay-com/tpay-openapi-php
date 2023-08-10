<?php

namespace tpaySDK\Model\Fields\PointOfSale;

use tpaySDK\Model\Fields\Field;

class Name extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 255;
}
