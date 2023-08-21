<?php

namespace Tpay\OpenApi\Model\Fields\Transaction;

use Tpay\OpenApi\Model\Fields\Field;

class Amount extends Field
{
    protected $name = __CLASS__;
    protected $type = self::NUMBER;
    protected $minimum = 0.01;
}
