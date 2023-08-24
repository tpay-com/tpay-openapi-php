<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): int
 */
class MerchantId extends Field
{
    protected $name = 'id';
    protected $type = self::INT;
}
