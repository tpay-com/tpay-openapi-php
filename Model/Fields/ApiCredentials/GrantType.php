<?php
namespace tpaySDK\Model\Fields\ApiCredentials;

use tpaySDK\Model\Fields\Field;

class GrantType extends Field
{
    protected $name = 'grant_type';

    protected $type = self::STRING;

    protected $enum = [
        'client_credentials',
    ];

}
