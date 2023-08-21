<?php

namespace Tpay\Model\Fields\CardPaymentData;

use Tpay\Model\Fields\Field;

class PreauthorizedToken extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
}
