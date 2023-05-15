<?php
namespace tpaySDK\Manager;

use tpaySDK\Model\Objects\ObjectsValidator;

class Manager
{
    protected $requestBody;

    protected $ObjectsValidator;

    public function __construct()
    {
        $this->ObjectsValidator = new ObjectsValidator();
    }

    public function setFields($fields, $strictCheck = true)
    {
        $this->requestBody->strictCheck = $strictCheck;
        $this->requestBody->setObjectValues($this->requestBody, $fields);
        $this->ObjectsValidator->isSetRequiredFields($this->requestBody);

        return $this;
    }

    public function setRequestBody($requestBody)
    {
        $this->requestBody = $requestBody;

        return $this;
    }

    public function getRequestBody()
    {
        return $this->requestBody;
    }

}
