<?php

namespace Tpay\Model\Fields\Account;

use Tpay\Model\Fields\Field;

class VerificationStatus extends Field
{
    protected $name = __CLASS__;
    protected $type = self::INT;
    protected $enum = [
        0,
        1,
    ];
}
