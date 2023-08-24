<?php

namespace Tpay\OpenApi\Model\Fields\PointOfSaleSettings;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): bool
 */
class IsTestMode extends Field
{
    protected $name = __CLASS__;
    protected $type = self::BOOL;
    protected $value = false;
}
