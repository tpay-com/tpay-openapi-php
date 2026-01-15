<?php

namespace Tpay\OpenApi\Model\Fields\Collect;

use Tpay\OpenApi\Model\Fields\Field;

class OwnerName extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $minLength = 3;
    protected $maxLength = 70;
}
