<?php

namespace Tpay\OpenApi\Model\Fields;

class FieldValidator implements FieldTypes
{
    /**
     * @param int    $maxLength
     * @param string $value
     *
     * @return bool
     */
    public function isTooLong($maxLength, $value)
    {
        return (bool) (strlen((string) $value) > $maxLength);
    }

    /**
     * @param int    $minLength
     * @param string $value
     *
     * @return bool
     */
    public function isTooShort($minLength, $value)
    {
        return (bool) (strlen((string) $value) < $minLength);
    }

    /**
     * @param string $value
     * @param string $pattern
     *
     * @return bool
     */
    public function isValidPattern($value, $pattern)
    {
        return !(1 !== preg_match('/'.$pattern.'/', $value));
    }

    /**
     * @param string $value
     * @param array  $enum
     *
     * @return bool
     */
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

    /**
     * @param string $fieldType
     * @param mixed  $value
     *
     * @return bool
     */
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
