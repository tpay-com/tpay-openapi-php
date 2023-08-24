<?php

namespace Tpay\OpenApi\Model\Fields\PointOfSaleDate;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Modification extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $pattern = '\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}';
}
