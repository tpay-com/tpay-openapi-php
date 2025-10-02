<?php

namespace Tpay\OpenApi\Model\Objects;

use InvalidArgumentException;
use ReflectionClass;
use Tpay\OpenApi\Model\Fields\Field;

class Objects implements ObjectsInterface
{
    const OBJECT_FIELDS = [];
    const UNIQUE_FIELDS = [];

    public $strictCheck = true;

    public function __construct()
    {
        $this->injectObjectFields(static::OBJECT_FIELDS);
    }

    /** @return array<Field|self> */
    public function getRequiredFields()
    {
        return [];
    }

    /** @return string */
    public function getName()
    {
        return (new ReflectionClass($this))->getShortName();
    }

    /**
     * @param object $object object name
     * @param array  $values array containing object fields with values
     *
     * @return $this
     */
    public function setObjectValues(&$object, $values)
    {
        foreach ($values as $fieldName => $fieldValue) {
            if (is_array($fieldValue) && property_exists($object, $fieldName)) {
                $this->setObjectsInArray($object, $fieldValue, $fieldName);
                continue;
            }
            if (property_exists($object, $fieldName) && $this->isField($object->{$fieldName})) {
                $object->{$fieldName}->setValue($fieldValue);
            } elseif (property_exists($object, $fieldName) && $this->isObject($object->{$fieldName})) {
                $this->setObjectValues($object->{$fieldName}, $fieldValue);
            } else {
                $errorField = $fieldName;
                if (0 === $errorField) {
                    $errorField = $fieldValue;
                }
                if (true === $this->strictCheck) {
                    throw new InvalidArgumentException(sprintf('Field %s is not supported', $errorField));
                }
            }
        }

        return $this;
    }

    /** @param array $objectFields */
    protected function injectObjectFields($objectFields)
    {
        foreach ($objectFields as $objectVar => $fieldClass) {
            if (is_array($fieldClass)) {
                $this->{$objectVar}[] = new $fieldClass[0]();
                continue;
            }
            $this->{$objectVar} = new $fieldClass();
        }
    }

    /**
     * @param object               $object
     * @param array<string, mixed> $fieldValue
     * @param string               $fieldName
     */
    private function setObjectsInArray($object, $fieldValue, $fieldName)
    {
        foreach ($fieldValue as $field => $value) {
            if (is_array($value)) {
                if (isset($object->{$fieldName}->{$field})) {
                    $this->setObjectValues($object->{$fieldName}->{$field}, $value);
                }
                if (is_array($object->{$fieldName})) {
                    if (!isset($object->{$fieldName}[$field])) {
                        $objectClass = get_class($object->{$fieldName}[0]);
                        $object->{$fieldName}[] = new $objectClass();
                    }

                    $this->setObjectValues($object->{$fieldName}[$field], $value);
                }
            } else {
                if (isset($object->{$fieldName}->{$field}) && $this->isField($object->{$fieldName}->{$field})) {
                    $object->{$fieldName}->{$field}->setValue($value);
                } else {
                    if (true === $this->strictCheck) {
                        throw new InvalidArgumentException(sprintf('Field %s is not supported', $field));
                    }
                }
            }
        }
    }

    /**
     * @param object|string $class
     *
     * @return bool
     */
    private function isField($class)
    {
        return is_subclass_of($class, Field::class);
    }

    /**
     * @param object|string $class
     *
     * @return bool
     */
    private function isObject($class)
    {
        return is_subclass_of($class, Objects::class);
    }
}
