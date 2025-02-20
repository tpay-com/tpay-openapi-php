<?php

namespace Tpay\OpenApi\Model\Fields\Notification\Tokenization;

use Tpay\OpenApi\Model\Fields\Field;

class Token extends Field
{
    protected $name = 'token';
    protected $type = self::STRING;
    protected $minLength = 64;
    protected $maxLength = 64;
}