<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class CardTrail extends Field
{
    protected $name = 'tokenPaymentData_cardTail';
    protected $type = self::STRING;
}
