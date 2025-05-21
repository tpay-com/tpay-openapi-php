<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class CardExpiryDate extends Field
{
    protected $name = 'tokenPaymentData_cardExpiryDate';
    protected $type = self::STRING;
}
