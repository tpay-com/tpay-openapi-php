<?php

namespace Tpay\OpenApi\Model\Objects;

use InvalidArgumentException;
use ReflectionClass;
use Tpay\OpenApi\Factory\ArrayObjectFactory;
use Tpay\OpenApi\Model\Fields\Field;

class Objects implements ObjectsInterface
{
    const OBJECT_FIELDS = [];
    const UNIQUE_FIELDS = [];

    private const PROVIDED_FIELDS_PROPERTY = 'providedFields';

    public $strictCheck = true;

    /** @var array<string, bool> */
    protected $providedFields = [];

    /** @var ArrayObjectFactory */
    private $factory;

    public function __construct()
    {
        $this->injectObjectFields(static::OBJECT_FIELDS);
        $this->factory = new ArrayObjectFactory();
    }

    /** @return array<Field|self> */
    public function getRequiredFields()
    {
        return [];
    }

    public function validate()
    {
        return true;
    }

    /** @param string $fieldName */
    public function wasFieldProvided($fieldName)
    {
        return isset($this->providedFields[$fieldName]);
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
            if (!is_object($object)) {
                continue;
            }

            if ($object instanceof self) {
                $object->markFieldProvided($fieldName);
            }

            if (!property_exists($object, $fieldName)) {
                if (true === $this->strictCheck) {
                    throw new InvalidArgumentException(
                        sprintf('Field %s is not supported', $fieldName)
                    );
                }

                continue;
            }

            if (self::PROVIDED_FIELDS_PROPERTY === $fieldName) {
                if (true === $this->strictCheck) {
                    throw new InvalidArgumentException(
                        sprintf('Field %s is not supported', $fieldName)
                    );
                }

                continue;
            }

            if (is_array($fieldValue) && is_array($object->{$fieldName})) {
                $this->setObjectsInArray($object, $fieldValue, $fieldName);

                continue;
            }

            if (is_array($fieldValue) && $this->isObject($object->{$fieldName})) {
                $this->setObjectValues($object->{$fieldName}, $fieldValue);

                continue;
            }

            if ($this->isField($object->{$fieldName})) {
                $object->{$fieldName}->setValue($fieldValue);

                continue;
            }

            if (true === $this->strictCheck) {
                throw new InvalidArgumentException(
                    sprintf('Field %s is not supported', $fieldName)
                );
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

    /** @param string $fieldName */
    protected function markFieldProvided($fieldName)
    {
        $this->providedFields[$fieldName] = true;
    }

    /**
     * @param object               $object
     * @param array<string, mixed> $fieldValue
     * @param string               $fieldName
     */
    private function setObjectsInArray($object, $fieldValue, $fieldName)
    {
        foreach ($fieldValue as $field => $value) {
            if (is_array($object->{$fieldName})) {
                if (!isset($object->{$fieldName}[$field])) {
                    $object->{$fieldName}[$field] = $this->factory->create($fieldName, $object);
                }
                $this->setObjectValues($object->{$fieldName}[$field], $value);

                continue;
            }

            if (is_array($value)) {
                if (isset($object->{$fieldName}->{$field})) {
                    $this->setObjectValues($object->{$fieldName}->{$field}, $value);
                }

                continue;
            }

            if (isset($object->{$fieldName}->{$field}) && $this->isField($object->{$fieldName}->{$field})) {
                $object->{$fieldName}->{$field}->setValue($value);

                continue;
            }

            if (true === $this->strictCheck) {
                throw new InvalidArgumentException(
                    sprintf('Field %s is not supported', $field)
                );
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
