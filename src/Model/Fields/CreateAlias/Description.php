<?php

namespace Tpay\OpenApi\Model\Fields\CreateAlias;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Description extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 105;
    protected $minLength = 1;
}
