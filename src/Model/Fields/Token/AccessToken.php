<?php

namespace Tpay\OpenApi\Model\Fields\Token;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class AccessToken extends Field
{
    protected $name = 'access_token';
    protected $type = self::STRING;
}
