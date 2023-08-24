<?php

namespace Tpay\OpenApi\Model\Fields\Token;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): int
 */
class IssuedAt extends Field
{
    protected $name = 'issued_at';
    protected $type = self::INT;
}
