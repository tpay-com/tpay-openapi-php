<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class CardBrand extends Field
{
    protected $name = 'tokenPaymentData_cardBrand';
    protected $type = self::STRING;
}
