<?php

namespace Tpay\OpenApi\Model\Fields\PersonContact;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Email extends Field
{
    protected $type = self::STRING;
    protected $name = __CLASS__;
    protected $maxLength = 255;
}
