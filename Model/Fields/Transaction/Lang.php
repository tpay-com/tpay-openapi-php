<?php

namespace tpaySDK\Model\Fields\Transaction;

use tpaySDK\Model\Fields\Field;

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
