<?php

namespace Tpay\OpenApi\Model\Fields\Account;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): int
 */
class VerificationStatus extends Field
{
    protected $name = __CLASS__;
    protected $type = self::INT;
    protected $enum = [
        0,
        1,
    ];
}
