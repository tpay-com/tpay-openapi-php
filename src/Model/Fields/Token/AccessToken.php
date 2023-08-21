<?php

namespace Tpay\Model\Fields\Token;

use Tpay\Model\Fields\Field;

class AccessToken extends Field
{
    protected $name = 'access_token';
    protected $type = self::STRING;
}
