<?php

namespace Tpay\OpenApi\Model\Fields\Collect;

use Tpay\OpenApi\Model\Fields\Field;

class Account extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $minLength = 1;
    protected $maxLength = 255;
}
