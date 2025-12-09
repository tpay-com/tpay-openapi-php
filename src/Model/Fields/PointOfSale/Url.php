<?php

namespace Tpay\OpenApi\Model\Fields\PointOfSale;

use Tpay\OpenApi\Model\Fields\Field;
use Tpay\OpenApi\Model\Fields\FieldValidationResult;

/**
 * @method getValue(): string
 */
class Url extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 3072;

    protected function initValidators()
    {
        $this->addValidator(function ($value) {
            if (!empty($value)) {
                if (!filter_var($value, FILTER_VALIDATE_URL)) {
                    return new FieldValidationResult(false, 'Invalid URL.');
                }
            }

            return new FieldValidationResult(true);
        });
    }
}
