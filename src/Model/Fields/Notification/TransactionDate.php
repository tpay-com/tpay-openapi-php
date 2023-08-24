<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class TransactionDate extends Field
{
    protected $name = 'tr_date';
    protected $type = self::STRING;
}
