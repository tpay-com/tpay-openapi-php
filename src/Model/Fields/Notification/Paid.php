<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): float|int
 */
class Paid extends Field
{
    protected $name = 'tr_paid';
    protected $type = self::NUMBER;
}
