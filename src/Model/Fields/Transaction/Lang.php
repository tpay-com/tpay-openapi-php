<?php

namespace Tpay\OpenApi\Model\Fields\Transaction;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Lang extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 2;
    protected $minLength = 2;
    protected $enum = [
        'en',
        'pl',
        'de',
        'fr',
        'ru',
        'it',
        'es',
    ];
}
