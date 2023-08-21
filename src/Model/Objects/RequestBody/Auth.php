<?php

namespace Tpay\Model\Objects\RequestBody;

use Tpay\Model\Fields\ApiCredentials\ClientSecret;
use Tpay\Model\Fields\ApiCredentials\Scope;
use Tpay\Model\Identifiers\ClientId;
use Tpay\Model\Objects\Objects;

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
