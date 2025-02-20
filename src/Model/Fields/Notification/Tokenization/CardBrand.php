<?php

namespace Tpay\OpenApi\Model\Fields\Notification\Tokenization;

use Tpay\OpenApi\Model\Fields\Field;

class CardBrand extends Field
{
    protected $name = 'cardBrand';
    protected $type = self::STRING;
    protected $enum = ['Mastercard', 'Visa'];
}
