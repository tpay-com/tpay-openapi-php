<?php

namespace Tpay\OpenApi\Model\Fields\Transaction;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class HiddenDescription extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 128;
}
