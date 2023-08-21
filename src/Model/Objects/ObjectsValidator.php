<?php

namespace Tpay\OpenApi\Model\Objects;

use Tpay\OpenApi\Model\Fields\Field;
use UnexpectedValueException;

class ObjectsValidator
{
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
}
