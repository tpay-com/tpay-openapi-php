<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class CardToken extends Field
{
    protected $name = 'card_token';
    protected $type = self::STRING;
}
