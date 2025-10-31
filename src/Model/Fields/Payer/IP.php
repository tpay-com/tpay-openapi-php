<?php

namespace Tpay\OpenApi\Model\Fields\Payer;

use Tpay\OpenApi\Model\Fields\Field;
use Tpay\OpenApi\Model\Fields\FieldValidationResult;

/**
 * @method getValue(): string
 */
class IP extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $minLength = 3;
    protected $maxLength = 255;

    protected function initValidators()
    {
        $this->addValidator(function ($value) {
            if (filter_var($value, FILTER_VALIDATE_IP) === false) {
                return new FieldValidationResult(false, 'Invalid IP address.');
            }
            return new FieldValidationResult(true);
        });
    }
}
