<?php

namespace Tpay\OpenApi\Model\Fields\ApiCredentials;

use Tpay\OpenApi\Model\Fields\Field;

class ClientSecret extends Field
{
    protected $name = 'client_secret';
    protected $type = self::STRING;
}
