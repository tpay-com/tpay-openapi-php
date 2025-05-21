<?php

namespace Tpay\OpenApi\Model\Fields\Notification\Tokenization;

use Tpay\OpenApi\Model\Fields\Field;

class Type extends Field
{
    protected $name = 'type';
    protected $type = self::STRING;
    protected $enum = ['tokenization', 'tokenization_eisop'];
}
