<?php

namespace Tpay\OpenApi\Model\Fields\Person;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class ExpiryDate extends Field
{
    protected $type = self::STRING;
    protected $pattern = '\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}';
    protected $name = __CLASS__;
}
