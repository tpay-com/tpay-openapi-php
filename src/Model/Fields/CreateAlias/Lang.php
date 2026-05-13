<?php

namespace Tpay\OpenApi\Model\Fields\CreateAlias;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Lang extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $enum = [
        'en',
        'pl',
        'de',
        'fr',
        'ru',
        'it',
        'es',
        'uk',
    ];
}
