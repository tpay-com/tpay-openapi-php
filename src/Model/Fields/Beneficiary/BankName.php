<?php

namespace Tpay\OpenApi\Model\Fields\Beneficiary;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class BankName extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
}
