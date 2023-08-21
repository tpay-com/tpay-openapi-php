<?php

namespace Tpay\OpenApi\Model\Fields\PointOfSaleSettings;

use Tpay\OpenApi\Model\Fields\Field;

class ConfirmationCode extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 32;
}
