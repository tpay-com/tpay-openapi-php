<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Description extends Field
{
    protected $name = 'tr_desc';
    protected $type = self::STRING;
}
