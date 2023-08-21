<?php

namespace Tpay\Model\Objects\RequestBody;

use Tpay\Model\Fields\ApiCredentials\GrantType;
use Tpay\Model\Objects\Objects;

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
