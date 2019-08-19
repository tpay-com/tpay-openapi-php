<?php
namespace tpaySDK\Model\Fields;

class FieldValidator implements FieldTypes
{
    public function isTooLong($maxLength, $value)
    {
        if (strlen($value) > $maxLength) {
            return true;
        }

        return false;
    }

    public function isTooShort($minLength, $value)
    {
        if (strlen($value) < $minLength) {
            return true;
        }

        return false;
    }

    public function isValidPattern($value, $pattern)
    {
        if (preg_match('/'.$pattern.'/', $value) !== 1) {
            return false;
        }

        return true;
    }

    public function isValidEnum($value, $enum)
    {
        if (is_array($enum)) {
            foreach (explode(' ', $value) as $fieldValue) {
                if (!in_array($fieldValue, $enum)) {
                    return false;
                }
            }
        }

        return true;
    }

    public function isValueValidType($fieldType, $value)
    {
        $isValid = true;
        if ($fieldType === static::BOOL) {
            $isValid = is_bool($value);
        }
        if ($fieldType === static::STRING) {
            $isValid = is_string($value);
        }
        if ($fieldType === static::INT) {
            $isValid = is_int($value);
        }
        if ($fieldType === static::NUMBER) {
            $isValid = is_numeric($value);
        }

        return $isValid;
    }

}
