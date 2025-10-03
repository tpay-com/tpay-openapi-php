<?php

namespace Tpay\OpenApi\Model\Fields\PersonContact;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Phone extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 30;
}
