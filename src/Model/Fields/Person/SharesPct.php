<?php

namespace Tpay\OpenApi\Model\Fields\Person;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): float|int
 */
class SharesPct extends Field
{
    protected $type = self::NUMBER;
    protected $value = 0;
    protected $name = __CLASS__;
    protected $maximum = 100;
    protected $minimum = 0;
}
