<?php

namespace Tpay\Model\Fields\Token;

use Tpay\Model\Fields\Field;

class IssuedAt extends Field
{
    protected $name = 'issued_at';
    protected $type = self::INT;
}
