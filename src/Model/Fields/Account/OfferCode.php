<?php

namespace Tpay\Model\Fields\Account;

use Tpay\Model\Fields\Field;

class OfferCode extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 5;
    protected $minLength = 5;
}
