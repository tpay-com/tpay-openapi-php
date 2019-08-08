<?php
namespace tpaySDK\Model\Objects\RequestBody;

use tpaySDK\Model\Fields\ApiCredentials\ClientSecret;
use tpaySDK\Model\Fields\ApiCredentials\Scope;
use tpaySDK\Model\Objects\ObjectHelper;
use tpaySDK\Model\Identifiers\ClientId;
use tpaySDK\Model\Objects\Objects;

class Auth extends Objects
{
    use ObjectHelper;

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
