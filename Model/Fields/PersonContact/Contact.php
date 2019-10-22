<?php
namespace tpaySDK\Model\Fields\PersonContact;

use tpaySDK\Model\Fields\Field;

class Contact extends Field
{
    protected $type = self::STRING;

    protected $maxLength = 255;

    protected $name = __CLASS__;

}
