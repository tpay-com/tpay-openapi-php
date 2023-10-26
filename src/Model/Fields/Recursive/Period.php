<?php

namespace Tpay\OpenApi\Model\Fields\Recursive;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): int
 */
class Period extends Field
{
    protected $name = __CLASS__;
    protected $type = self::INT;
    protected $enum = [1, 2, 3, 4, 5];
}
