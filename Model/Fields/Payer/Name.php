<?php
namespace tpaySDK\Model\Fields\Payer;

use tpaySDK\Model\Fields\Field;

class Name extends Field
{
    protected $name = __CLASS__;

    protected $type = self::STRING;

    protected $minLength = 3;

    protected $maxLength = 255;

}
