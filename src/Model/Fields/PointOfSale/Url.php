<?php

namespace Tpay\OpenApi\Model\Fields\PointOfSale;

use Tpay\OpenApi\Model\Fields\Field;

/**
 * @method getValue(): string
 */
class Url extends Field
{
    protected $name = __CLASS__;
    protected $type = self::STRING;
    protected $maxLength = 255;
    protected $pattern = 'https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,12}\b([-a-zA-Z0-9@:%_\+.~#?&\/=]*)';
}
