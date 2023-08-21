<?php

namespace Tpay\Model\Fields\BlikPaymentData;

use Tpay\Model\Fields\Field;

class BlikToken extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 6;
    protected $minLength = 6;
}
