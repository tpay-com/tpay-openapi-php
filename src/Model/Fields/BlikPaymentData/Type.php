<?php

namespace Tpay\Model\Fields\BlikPaymentData;

use Tpay\Model\Fields\Field;

class Type extends Field
{
    protected $name = __CLASS__;
    protected $type = self::INT;
    protected $enum = [0, 1];
}
