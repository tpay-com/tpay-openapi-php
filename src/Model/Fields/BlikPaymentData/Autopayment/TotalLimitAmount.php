<?php

namespace Tpay\OpenApi\Model\Fields\BlikPaymentData\Autopayment;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): float
 */
class TotalLimitAmount extends Field
{
    protected $name = __CLASS__;
    protected $type = self::NUMBER;
}
