<?php

namespace Tpay\OpenApi\Model\Fields\Beneficiary;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): float|int
 */
class PercentageShares extends Field
{
    protected $name = __CLASS__;
    protected $type = self::NUMBER;
}
