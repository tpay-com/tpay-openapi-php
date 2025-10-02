<?php

namespace Tpay\OpenApi\Manager;

use Tpay\OpenApi\Model\Objects\Objects;
use Tpay\OpenApi\Model\Objects\ObjectsValidator;
use Tpay\OpenApi\Model\Objects\RequestBody\Merchant;

class Manager
{
    /** @var Objects */
    protected $requestBody;

    /** @var ObjectsValidator */
    protected $ObjectsValidator;

    public function __construct()
    {
        $this->ObjectsValidator = new ObjectsValidator();
    }

    /**
     * @param array $fields
     * @param bool  $strictCheck
     *
     * @return $this
     */
    public function setFields($fields, $strictCheck = true)
    {
        $this->requestBody->strictCheck = $strictCheck;
        $this->requestBody->setObjectValues($this->requestBody, $fields);
        $this->ObjectsValidator->isSetRequiredFields($this->requestBody);
        if ($this->requestBody instanceof Merchant) {
            $this->ObjectsValidator->checkUniqueFields($this->requestBody);

        }

        return $this;
    }

    /**
     * @param Objects $requestBody
     *
     * @return $this
     */
    public function setRequestBody($requestBody)
    {
        $this->requestBody = $requestBody;

        return $this;
    }

    /** @return Objects */
    public function getRequestBody()
    {
        return $this->requestBody;
    }
}
