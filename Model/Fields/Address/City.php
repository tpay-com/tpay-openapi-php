<?php
namespace tpaySDK\Model\Fields\Address;

use tpaySDK\Model\Fields\Field;

class City extends Field
{
    protected $name = __CLASS__;

    protected $type = self::STRING;

    protected $maxLength = 255;

    protected $minLength = 2;

}
