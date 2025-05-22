<?php

namespace Tpay\OpenApi\Model\Fields\ApplePay;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class ValidationUrl extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 255;
    protected $pattern = 'http.+';
}
