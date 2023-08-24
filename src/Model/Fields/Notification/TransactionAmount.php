<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): float|int
 */
class TransactionAmount extends Field
{
    protected $name = 'tr_amount';
    protected $type = self::NUMBER;
}
