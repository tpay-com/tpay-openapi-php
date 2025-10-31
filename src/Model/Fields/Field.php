<?php

namespace Tpay\OpenApi\Model\Fields;

use InvalidArgumentException;

class Field implements FieldTypes
{
    /** @var string */
    protected $name = __CLASS__;

    /** @var string */
    protected $type;

    /** @var int */
    protected $maxLength;

    /** @var int */
    protected $minLength;

    /** @var float|int */
    protected $minimum;

    /** @var float|int */
    protected $maximum;

    /** @var bool|int */
    protected $value;

    /** @var string */
    protected $pattern;

    /** @var array<string> */
    protected $enum;

    /** @var FieldValidator */
    protected $FieldValidator;

    /** @var array<callable> */
    protected $customValidators = [];

    /** @var array<string> */
    private $errors = [];

    public function __construct()
    {
        $this->FieldValidator = new FieldValidator();
        $this->initValidators();
    }

    public function getValue()
    {
        return $this->value;
    }

    /** @return string */
    public function getType()
    {
        return $this->type;
    }

    /** @return string */
    public function getName()
    {
        return $this->name;
    }

    public function addValidator(callable $callback)
    {
        $this->customValidators[] = $callback;
    }

    public function setValue($value)
    {
        $this->checkMaximum($value);
        $this->checkMinimum($value);
        $this->checkMaxLength($value);
        $this->checkMinLength($value);
        if (!is_null($value)) {
            $this->checkValue($value);
        }
        if (!empty($this->customValidators)) {
            $this->checkCustomValidators($value);
        }
        if (!empty($this->errors)) {
            throw new InvalidArgumentException(print_r($this->errors, true));
        }
        $this->value = $value;

        return $this;
    }

    /** @param string $value */
    public function checkMaxLength($value)
    {
        if ($this->maxLength > 0 && $this->FieldValidator->isTooLong($this->maxLength, $value)) {
            $this->errors[] = sprintf('Value of field %s is too long. Max allowed %s', $this->name, $this->maxLength);
        }
    }

    /** @param string $value */
    public function checkMinLength($value)
    {
        if ($this->minLength > 0 && $this->FieldValidator->isTooShort($this->minLength, $value)) {
            $this->errors[] = sprintf('Value of field %s is too short. Min required %s', $this->name, $this->minLength);
        }
    }

    public function checkMaximum($value)
    {
        if ($this->maximum > 0 && $value > $this->maximum) {
            $this->errors[] = sprintf(
                'Value of field %s exceeds the limit. Max allowed %s',
                $this->name,
                $this->maximum
            );
        }
    }

    public function checkMinimum($value)
    {
        if (is_numeric($this->minimum) && $value < $this->minimum) {
            $this->errors[] = sprintf('Value of field %s is too low. Min required %s', $this->name, $this->minimum);
        }
    }

    public function checkValue($value)
    {
        if (!is_null($this->pattern) && false === $this->FieldValidator->isValidPattern($value, $this->pattern)) {
            $this->errors[] = sprintf(
                'Value of field %s is invalid. Should match %s pattern',
                $this->name,
                $this->pattern
            );
        }
        if (!is_null($this->enum) && false === $this->FieldValidator->isValidEnum($value, $this->enum)) {
            $this->errors[] = sprintf(
                'Value of field %s is invalid. Should be one of %s',
                $this->name,
                print_r($this->enum, true)
            );
        }
        if (false === $this->FieldValidator->isValueValidType($this->type, $value)) {
            $this->errors[] = sprintf(
                'Value type of field %s is invalid. Should be %s type',
                $this->name,
                $this->type
            );
        }
    }

    protected function initValidators() {}

    private function checkCustomValidators($value)
    {
        foreach ($this->customValidators as $validator) {
            $result = $validator($value, $this);

            if (!$result instanceof FieldValidationResultInterface) {
                throw new InvalidArgumentException(
                    'Custom validator must return an instance of FieldValidationResultInterface.'
                );
            }

            if (!$result->isValid()) {
                $this->errors[] = sprintf(
                    'Validation failed for field %s: %s',
                    $this->name,
                    (string) $result->getMessage()
                );
            }
        }
    }
}
