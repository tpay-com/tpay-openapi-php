<?php
namespace tpaySDK\Model\Objects;

use InvalidArgumentException;
use tpaySDK\Model\Fields\Field;

trait ObjectHelper
{
    /**
     * @param string $field Field name
     * @param $value
     * @return $this
     */
    public function setFieldValue($field, $value)
    {
        if (!property_exists($this, $field)) {
            throw new InvalidArgumentException(sprintf('Field %s does not exists in %s', $field, __CLASS__));
        }
        $this->$field->setValue($value);

        return $this;
    }

    /**
     * @param string $object object name
     * @param array $values array containing object fields with values
     * @return $this
     */
    public function setObjectValues(&$object, $values)
    {
        foreach ($values as $fieldName => $fieldValue) {
            if (is_array($fieldValue) && property_exists($object, $fieldName)) {
                $this->setObjectsInArray($object, $fieldValue, $fieldName);
                continue;
            }
            if (property_exists($object, $fieldName) && $this->isField($object->$fieldName)) {
                $object->$fieldName->setValue($fieldValue);
            } elseif (property_exists($object, $fieldName) && $this->isObject($object->$fieldName)) {
                $this->setObjectValues($object->$fieldName, $fieldValue);
            } else {
                $errorField = $fieldName;
                if ($errorField === 0) {
                    $errorField = $fieldValue;
                }
                throw new InvalidArgumentException(sprintf('Field %s is not supported', $errorField));
            }
        }

        return $this;
    }

    /**
     * @param object $object
     * @param $field field name
     * @param array $value of field to be set
     * @return $this
     */
    public function setObjectFieldValue($object, $field, $value)
    {
        if (!property_exists($object, $field)) {
            throw new InvalidArgumentException(sprintf('Field %s does not exists in %s', $field, $object));
        }
        $this->$object->$field->setValue($value);

        return $this;
    }

    private function isField($class)
    {
        return is_subclass_of($class, Field::class);
    }

    private function isObject($class)
    {
        return is_subclass_of($class, Objects::class);
    }

    private function setObjectsInArray($object, $fieldValue, $fieldName)
    {
        foreach ($fieldValue as $field => $value) {
            if (is_array($value)) {
                if (isset($object->$fieldName->$field)) {
                    $this->setObjectValues($object->$fieldName->$field, $value);
                }
                if (is_array($object->$fieldName)) {
                    $this->setObjectValues($object->$fieldName[$field], $value);
                }
            } else {
                if (isset($object->$fieldName->$field) && $this->isField($object->$fieldName->$field)) {
                    $object->$fieldName->$field->setValue($value);
                } else {
                    throw new InvalidArgumentException(sprintf('Field %s is not supported', $field));
                }
            }
        }
    }

}
