<?php

namespace Tpay\OpenApi\Model\Fields\Notification\Tokenization;

use Tpay\OpenApi\Model\Fields\Field;

class CardTail extends Field
{
    protected $name = 'cardTail';
    protected $type = self::STRING;
    protected $minLength = 4;
    protected $maxLength = 4;
}