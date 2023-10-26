<?php

namespace Tpay\OpenApi\Model\Fields\Recursive;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class ExpirationDate extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $pattern = '\d{4}-\d{2}-\d{2}';
}
