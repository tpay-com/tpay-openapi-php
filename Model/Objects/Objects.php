<?php
namespace tpaySDK\Model\Objects;

use ReflectionClass;

class Objects implements ObjectsInterface
{
    const OBJECT_FIELDS = [];

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
                $this->$objectVar[] = new $fieldClass[0];
                continue;
            }
            $this->$objectVar = new $fieldClass;
        }
    }

}
