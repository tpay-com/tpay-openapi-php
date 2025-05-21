<?php

namespace Tpay\OpenApi\Model\Objects\RequestBody;

use Tpay\OpenApi\Model\Fields\ApiCredentials\GrantType;
use Tpay\OpenApi\Model\Objects\Objects;

class BasicAuth extends Objects
{
    public const OBJECT_FIELDS = [
        'grant_type' => GrantType::class,
    ];

    /** @var GrantType */
    public $grant_type;
}
