<?php

namespace Tpay\Model\Fields\Person;

use Tpay\Model\Fields\Field;

class SharesPct extends Field
{
    protected $type = self::NUMBER;
    protected $value = 0;
    protected $name = __CLASS__;
    protected $maximum = 100;
    protected $minimum = 0;
}
