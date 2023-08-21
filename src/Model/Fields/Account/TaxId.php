<?php

namespace Tpay\OpenApi\Model\Fields\Account;

use Tpay\OpenApi\Model\Fields\Field;

class TaxId extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 10;
    protected $minLength = 10;
}
