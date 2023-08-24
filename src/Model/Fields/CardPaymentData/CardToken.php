<?php

namespace Tpay\OpenApi\Model\Fields\CardPaymentData;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class CardToken extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
}
