<?php

namespace Tpay\OpenApi\Model\Fields\PersonContact;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Contact extends Field
{
    protected $type = self::STRING;
    protected $maxLength = 255;
    protected $name = __CLASS__;
}
