<?php

namespace tpaySDK\Model\Fields\ApiCredentials;

use tpaySDK\Model\Fields\Field;

class ClientSecret extends Field
{
    protected $name = 'client_secret';
    protected $type = self::STRING;
}
