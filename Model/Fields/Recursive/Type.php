<?php

namespace tpaySDK\Model\Fields\Recursive;

use tpaySDK\Model\Fields\Field;

class Type extends Field
{
    protected $name = __CLASS__;
    protected $type = self::INT;
    protected $enum = [1];
}
