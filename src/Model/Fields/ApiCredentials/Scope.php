<?php

namespace Tpay\OpenApi\Model\Fields\ApiCredentials;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Scope extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $enum = [
        'read',
        'write',
        'read write',
    ];
}
