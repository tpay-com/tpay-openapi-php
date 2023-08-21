<?php

namespace Tpay\OpenApi\Model\Fields\ApiCredentials;

use Tpay\OpenApi\Model\Fields\Field;

class GrantType extends Field
{
    protected $name = 'grant_type';
    protected $type = self::STRING;
    protected $enum = [
        'client_credentials',
    ];
}
