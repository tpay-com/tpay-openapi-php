<?php

namespace Tpay\OpenApi\Model\Fields;

class FieldValidationResult implements FieldValidationResultInterface
{
    /** @var bool */
    private $valid;

    /** @var null|string  */
    private $message;

    public function __construct($valid, $message = null)
    {
        $this->valid = $valid;
        $this->message = $message;
    }

    /** @return bool */
    public function isValid()
    {
        return $this->valid;
    }

    /** @return string|null */
    public function getMessage()
    {
        return $this->message;
    }
}
