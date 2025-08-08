<?php

namespace Tpay\OpenApi\Model\Fields\Collect;

use Tpay\OpenApi\Model\Fields\Field;

class Account extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $minLength = 28;
    protected $maxLength = 28;
    protected $pattern = '^PL\d{26}$';
}
