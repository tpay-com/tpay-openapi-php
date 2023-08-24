<?php

namespace Tpay\OpenApi\Model\Fields\Person;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): bool
 */
class IsContactPerson extends Field
{
    protected $type = self::BOOL;
    protected $value = false;
    protected $name = __CLASS__;
}
