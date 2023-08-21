<?php

namespace Tpay\OpenApi\Model\Identifiers;

use Tpay\OpenApi\Model\Fields\Field;

class ClientId extends Field
{
    protected $name = 'client_id';
    protected $type = self::STRING;
}
