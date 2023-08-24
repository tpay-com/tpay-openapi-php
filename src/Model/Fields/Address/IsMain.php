<?php

namespace Tpay\OpenApi\Model\Fields\Address;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): bool
 */
class IsMain extends Field
{
    protected $name = __CLASS__;
    protected $type = self::BOOL;
    protected $value = true;
}
