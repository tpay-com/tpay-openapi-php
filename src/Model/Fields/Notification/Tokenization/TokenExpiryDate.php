<?php

namespace Tpay\OpenApi\Model\Fields\Notification\Tokenization;

use Tpay\OpenApi\Model\Fields\Field;

class TokenExpiryDate extends Field
{
    protected $name = 'tokenExpiryDate';
    protected $type = self::STRING;
    protected $minLength = 4;
    protected $maxLength = 4;
}