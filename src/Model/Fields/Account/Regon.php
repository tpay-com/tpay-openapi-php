<?php

namespace Tpay\OpenApi\Model\Fields\Account;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Regon extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 14;
    protected $minLength = 9;
}
