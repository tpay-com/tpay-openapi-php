<?php

namespace Tpay\OpenApi\Model\Objects\RequestBody;

use Tpay\OpenApi\Model\Fields\ApplePay\DisplayName;
use Tpay\OpenApi\Model\Fields\ApplePay\Domain;
use Tpay\OpenApi\Model\Fields\ApplePay\ValidationUrl;
use Tpay\OpenApi\Model\Objects\Objects;

class InitApplePay extends Objects
{
    public const OBJECT_FIELDS = [
        'domainName' => Domain::class,
        'displayName' => DisplayName::class,
        'validationUrl' => ValidationUrl::class,
    ];

    public $domainName;
    public $displayName;
    public $validationUrl;
}
