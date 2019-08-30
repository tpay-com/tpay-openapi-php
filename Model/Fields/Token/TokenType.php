<?php
namespace tpaySDK\Model\Fields\Token;

use tpaySDK\Model\Fields\Field;

class TokenType extends Field
{
    protected $name = 'token_type';

    protected $type = self::STRING;

    protected $enum = 'Bearer';

}
