<?php

namespace Tpay\Model\Fields\Person;

use Tpay\Model\Fields\Field;

class ExpiryDate extends Field
{
    protected $type = self::STRING;
    protected $pattern = '\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}';
    protected $name = __CLASS__;
}
