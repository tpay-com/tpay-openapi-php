<?php

namespace Tpay\OpenApi\Model\Fields\Payer;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class IP extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $minLength = 3;
    protected $maxLength = 255;
    protected $pattern = '^([0-9]{1,3}\.){3}[0-9]{1,3}$';
}
