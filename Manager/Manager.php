<?php
namespace tpaySDK\Manager;

use tpaySDK\Model\Objects\ObjectHelper;
use tpaySDK\Model\Objects\ObjectsValidator;

class Manager
{
    use ObjectHelper;

    protected $requestBody;

    protected $ObjectsValidator;

    public function __construct()
    {
        $this->ObjectsValidator = new ObjectsValidator;
    }

    public function setFields($fields)
    {
        $this->setObjectValues($this->requestBody, $fields);
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
