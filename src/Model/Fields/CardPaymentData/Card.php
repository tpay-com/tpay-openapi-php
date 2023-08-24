<?php

namespace Tpay\OpenApi\Model\Fields\CardPaymentData;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Card extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
}
