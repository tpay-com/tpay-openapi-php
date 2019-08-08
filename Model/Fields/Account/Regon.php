<?php
namespace tpaySDK\Model\Fields\Account;

use tpaySDK\Model\Fields\Field;

class Regon extends Field
{
    protected $name = __CLASS__;

    protected $type = self::STRING;

    protected $maxLength = 14;

    protected $minLength = 9;

}
