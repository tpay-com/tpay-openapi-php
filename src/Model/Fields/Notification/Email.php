<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Email extends Field
{
    protected $name = 'tr_email';
    protected $type = self::STRING;
}
