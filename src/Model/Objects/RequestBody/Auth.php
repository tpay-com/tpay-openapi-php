<?php

namespace Tpay\OpenApi\Model\Objects\RequestBody;

use Tpay\OpenApi\Model\Fields\ApiCredentials\ClientSecret;
use Tpay\OpenApi\Model\Fields\ApiCredentials\Scope;
use Tpay\OpenApi\Model\Identifiers\ClientId;
use Tpay\OpenApi\Model\Objects\Objects;

class Auth extends Objects
{
    const OBJECT_FIELDS = [
        'client_id' => ClientId::class,
        'client_secret' => ClientSecret::class,
        'scope' => Scope::class,
    ];

    /**
     * @var ClientId
     */
    public $client_id;

    /**
     * @var ClientSecret
     */
    public $client_secret;

    /**
     * @var Scope
     */
    public $scope;

    public function getRequiredFields()
    {
        return [
            $this->client_id,
            $this->client_secret,
        ];
    }
}
