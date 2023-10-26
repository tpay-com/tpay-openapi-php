<?php

namespace Tpay\OpenApi\Model\Fields\Payer;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Address extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $minLength = 2;
    protected $maxLength = 255;
}
