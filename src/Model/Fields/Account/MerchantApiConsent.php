<?php

namespace Tpay\OpenApi\Model\Fields\Account;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): bool
 */
class MerchantApiConsent extends Field
{
    protected $name = __CLASS__;
    protected $type = self::BOOL;
    protected $value = false;
}
