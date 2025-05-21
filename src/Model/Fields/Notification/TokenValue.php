<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class TokenValue extends Field
{
    protected $name = 'tokenPaymentData_tokenValue';
    protected $type = self::STRING;
}
