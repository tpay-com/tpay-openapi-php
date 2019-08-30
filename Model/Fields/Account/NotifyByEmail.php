<?php
namespace tpaySDK\Model\Fields\Account;

use tpaySDK\Model\Fields\Field;

class NotifyByEmail extends Field
{
    protected $name = __CLASS__;

    protected $type = self::BOOL;

    protected $value = true;

}
