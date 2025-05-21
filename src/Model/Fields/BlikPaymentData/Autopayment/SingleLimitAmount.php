<?php

namespace Tpay\OpenApi\Model\Fields\BlikPaymentData\Autopayment;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class SingleLimitAmount extends Field
{
    protected $name = __CLASS__;
    protected $type = self::INT;
}
