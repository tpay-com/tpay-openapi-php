<?php

namespace Tpay\OpenApi\Model\Fields\Notification;

use Tpay\OpenApi\Model\Fields\Field;

class Md5sum extends Field
{
    protected $name = 'md5sum';
    protected $type = self::STRING;
    protected $minLength = 32;
    protected $maxLength = 32;
}
