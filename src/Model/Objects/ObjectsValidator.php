<?php

namespace Tpay\OpenApi\Model\Objects;

use Tpay\OpenApi\Model\Fields\Field;
use UnexpectedValueException;

class ObjectsValidator
{
    /**
     * @param Objects $objectClass
     */
    public function checkUniqueFields($objectClass)
    {
        foreach ($objectClass::UNIQUE_FIELDS as $collectionName => $fieldRules) {
            $collection = isset($objectClass->{$collectionName}) ? $objectClass->{$collectionName} : [];

            foreach ($fieldRules as $fieldName => $uniqueValue) {
                $this->validateUniqueField($collection, $fieldName, $uniqueValue);
            }
        }
    }

    /**
     * @param Objects $objectClass
     *
     * @throws UnexpectedValueException
     *
     * @return bool
     */
    public function isSetRequiredFields($objectClass)
    {
        $requiredFields = $objectClass->getRequiredFields();
        foreach ($requiredFields as $field) {
            if (is_subclass_of($field, Objects::class)) {
                $this->isSetRequiredFields($field);
                continue;
            }
            if (is_array($field)) {
                foreach ($field as $value) {
                    $this->isSetRequiredFields($value);
                }
                continue;
            }
            /** @var Field $field */
            if (is_null($field->getValue())) {
                throw new UnexpectedValueException(
                    sprintf('Field "%s" is required in object %s', $field->getName(), $objectClass->getName())
                );
            }
        }

        return true;
    }

    /**
     * @param array<Objects> $objects
     * @param mixed $fieldName
     * @param mixed $uniqueValue
     *
     * @throws UnexpectedValueException
     */
    private function validateUniqueField(array $objects, $fieldName, $uniqueValue)
    {
        $count = 0;

        foreach ($objects as $object) {
            if (!$object instanceof Objects) {
                continue;
            }

            if (!property_exists($object, $fieldName)) {
                continue;
            }

            $field = $object->{$fieldName};

            if ($field instanceof Field && $field->getValue() === $uniqueValue) {
                $count++;
            }

            if ($count > 1) {
                throw new UnexpectedValueException(sprintf(
                    'Field "%s" with value "%s" must be unique across %s objects',
                    $fieldName,
                    var_export($uniqueValue, true),
                    $object->getName()
                ));
            }
        }
    }
}
