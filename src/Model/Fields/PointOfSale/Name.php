<?php

namespace Tpay\OpenApi\Model\Fields\PointOfSale;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Name extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 255;
}
