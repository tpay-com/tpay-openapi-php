<?php
namespace tpaySDK\Model\Fields\Address;

use tpaySDK\Model\Fields\Field;

class Name extends Field
{
    protected $name = __CLASS__;

    protected $type = self::STRING;

    protected $maxLength = 128;

    protected $minLength = 1;

}
