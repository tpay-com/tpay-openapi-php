<?php

namespace Tpay\Model\Fields\ApiCredentials;

use Tpay\Model\Fields\Field;

class ClientSecret extends Field
{
    protected $name = 'client_secret';
    protected $type = self::STRING;
}
