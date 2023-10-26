<?php

namespace Tpay\OpenApi\Model\Fields\Account;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class OfferCode extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 5;
    protected $minLength = 5;
}
