<?php

namespace Tpay\OpenApi\Model\Fields\Recurring\Schedule;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): int
 */
class AnchorDay extends Field
{
    protected $name = __CLASS__;
    protected $type = self::INT;
    protected $minimum = 1;
    protected $maximum = 31;

    public function checkMinimum($value)
    {
        if (is_null($value)) {
            return;
        }

        parent::checkMinimum($value);
    }
}
