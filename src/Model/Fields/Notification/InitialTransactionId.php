<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class InitialTransactionId extends Field
{
    protected $name = 'tokenPaymentData_initialTransactionId';
    protected $type = self::STRING;
}
