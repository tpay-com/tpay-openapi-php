<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Wallet extends Field
{
    protected $name = 'wallet';
    protected $type = self::STRING;
}
