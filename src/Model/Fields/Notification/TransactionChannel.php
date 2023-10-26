<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): int
 */
class TransactionChannel extends Field
{
    protected $name = 'tr_channel';
    protected $type = self::INT;
}
