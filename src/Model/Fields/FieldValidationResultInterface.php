<?php

namespace Tpay\OpenApi\Model\Fields;

interface FieldValidationResultInterface
{
    /**
     * @return bool
     */
    public function isValid();

    /**
     * @return string|null
     */
    public function getMessage();
}