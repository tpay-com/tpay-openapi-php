<?php

namespace Tpay\OpenApi\Model\Fields\Token;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): int
 */
class ExpiresIn extends Field
{
    protected $name = 'expires_in';
    protected $type = self::INT;
}
