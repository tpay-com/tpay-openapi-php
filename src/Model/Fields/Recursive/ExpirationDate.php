<?php

namespace Tpay\Model\Fields\Recursive;

use Tpay\Model\Fields\Field;

class ExpirationDate extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $pattern = '\d{4}-\d{2}-\d{2}';
}
