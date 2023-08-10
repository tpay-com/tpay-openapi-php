<?php

namespace tpaySDK\Model\Fields\Person;

use tpaySDK\Model\Fields\Field;

class IsRepresentative extends Field
{
    protected $type = self::BOOL;
    protected $value = false;
    protected $name = __CLASS__;
}
