<?php

namespace Tpay\OpenApi\Model\Fields\Person;

use Tpay\OpenApi\Model\Fields\Field;

class Surname extends Field
{
    protected $type = self::STRING;
    protected $maxLength = 56;
    protected $name = __CLASS__;
}
