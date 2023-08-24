<?php

namespace Tpay\OpenApi\Model\Fields\Recursive;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): int
 */
class Quantity extends Field
{
    protected $name = __CLASS__;
    protected $type = self::INT;
}
