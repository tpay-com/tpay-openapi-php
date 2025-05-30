<?php

namespace Tpay\OpenApi\Model\Fields\TokenPaymentData;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class InitialTransactionId extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 22;
}
