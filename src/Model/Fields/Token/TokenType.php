<?php

namespace Tpay\OpenApi\Model\Fields\Token;

use Tpay\OpenApi\Model\Fields\Field;

class TokenType extends Field
{
    protected $name = 'token_type';
    protected $type = self::STRING;
    protected $enum = 'Bearer';
}
