<?php

namespace Tpay\Model\Fields\PointOfSaleSettings;

use Tpay\Model\Fields\Field;

class ConfirmationCode extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 32;
}
