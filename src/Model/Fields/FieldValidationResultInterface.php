<?php

namespace Tpay\OpenApi\Model\Fields;

interface FieldValidationResultInterface
{
    /**@return bool */
    public function isValid();

    /** @return null|string */
    public function getMessage();
}