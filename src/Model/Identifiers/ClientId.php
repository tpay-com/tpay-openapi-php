<?php

namespace Tpay\Model\Identifiers;

use Tpay\Model\Fields\Field;

class ClientId extends Field
{
    protected $name = 'client_id';
    protected $type = self::STRING;
}
