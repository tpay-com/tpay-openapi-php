<?php

namespace Tpay\Model\Fields\Token;

use Tpay\Model\Fields\Field;

class TokenType extends Field
{
    protected $name = 'token_type';
    protected $type = self::STRING;
    protected $enum = 'Bearer';
}
