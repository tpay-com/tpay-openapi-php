<?php

namespace Tpay\OpenApi\Model\Fields\Payer;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class TaxId extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $minLength = 3;
    protected $maxLength = 255;
}
