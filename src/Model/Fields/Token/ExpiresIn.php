<?php

namespace Tpay\Model\Fields\Token;

use Tpay\Model\Fields\Field;

class ExpiresIn extends Field
{
    protected $name = 'expires_in';
    protected $type = self::INT;
}
