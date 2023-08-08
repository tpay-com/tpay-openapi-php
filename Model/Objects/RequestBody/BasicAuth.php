<?php

namespace tpaySDK\Model\Objects\RequestBody;

use tpaySDK\Model\Fields\ApiCredentials\GrantType;
use tpaySDK\Model\Objects\Objects;

class BasicAuth extends Objects
{
    const OBJECT_FIELDS = [
        'grant_type' => GrantType::class,
    ];

    /**
     * @var GrantType
     */
    public $grant_type;
}
