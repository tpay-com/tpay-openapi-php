<?php

namespace Tpay\OpenApi\Model\Fields\Collect;

use Tpay\OpenApi\Model\Fields\Field;

class AdditionalInformation extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 1000;
}
