<?php
namespace tpaySDK\Model\Fields\Person;

use tpaySDK\Model\Fields\Field;

class Name extends Field
{
    protected $name = __CLASS__;

    protected $type = self::STRING;

    protected $maxLength = 56;

    protected $minLength = 1;

}
