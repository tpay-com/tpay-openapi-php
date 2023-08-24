<?php

namespace Tpay\OpenApi\Model\Fields\Alias;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Type extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $enum = [
        'UID',
        'PAYID',
    ];
}
