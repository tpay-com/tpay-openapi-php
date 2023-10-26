<?php

namespace Tpay\OpenApi\Model\Fields\Address;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class RoomNumber extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 10;
}
