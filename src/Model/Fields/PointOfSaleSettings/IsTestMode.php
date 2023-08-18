<?php

namespace Tpay\Model\Fields\PointOfSaleSettings;

use Tpay\Model\Fields\Field;

class IsTestMode extends Field
{
    protected $name = __CLASS__;
    protected $type = self::BOOL;
    protected $value = false;
}
