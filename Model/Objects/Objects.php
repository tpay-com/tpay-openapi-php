<?php
namespace tpaySDK\Model\Objects;

use InvalidArgumentException;
use ReflectionClass;
use tpaySDK\Model\Fields\Field;

class Objects implements ObjectsInterface
{
    const OBJECT_FIELDS = [];

    public $strictCheck = true;

    public function __construct()
    {
        $this->injectObjectFields(static::OBJECT_FIELDS);
    }

    public function getRequiredFields()
    {
        return [];
    }

    public function getName()
    {
        return (new ReflectionClass($this))->getShortName();
    }

    protected function injectObjectFields($objectFields)
    {
        foreach ($objectFields as $objectVar => $fieldClass) {
            if (is_array($fieldClass)) {
                $this->{$objectVar}[] = new $fieldClass[0];
                continue;
            }
            $this->$objectVar = new $fieldClass;
        }
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
                $object->{$fieldName}->setValue($fieldValue);
            } elseif (property_exists($object, $fieldName) && $this->isObject($object->$fieldName)) {
                $this->setObjectValues($object->$fieldName, $fieldValue);
            } else {
                $errorField = $fieldName;
                if ($errorField === 0) {
                    $errorField = $fieldValue;
                }
                if ($this->strictCheck === true) {
                    throw new InvalidArgumentException(sprintf('Field %s is not supported', $errorField));
                }
            }
        }

        return $this;
    }

    private function setObjectsInArray($object, $fieldValue, $fieldName)
    {
        foreach ($fieldValue as $field => $value) {
            if (is_array($value)) {
                if (isset($object->{$fieldName}->$field)) {
                    $this->setObjectValues($object->{$fieldName}->$field, $value);
                }
                if (is_array($object->$fieldName)) {
                    $this->setObjectValues($object->{$fieldName}[$field], $value);
                }
            } else {
                if (isset($object->{$fieldName}->$field) && $this->isField($object->{$fieldName}->$field)) {
                    $object->{$fieldName}->$field->setValue($value);
                } else {
                    if ($this->strictCheck === true) {
                        throw new InvalidArgumentException(sprintf('Field %s is not supported', $field));
                    }
                }
            }
        }
    }

    private function isField($class)
    {
        return is_subclass_of($class, Field::class);
    }

    private function isObject($class)
    {
        return is_subclass_of($class, Objects::class);
    }

}
