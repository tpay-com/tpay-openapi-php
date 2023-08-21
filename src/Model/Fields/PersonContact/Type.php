<?php

namespace Tpay\OpenApi\Model\Fields\PersonContact;

use Tpay\OpenApi\Model\Fields\Field;

class Type extends Field
{
    protected $type = self::INT;
    protected $enum = [1, 2, 3];
    protected $name = __CLASS__;
}
