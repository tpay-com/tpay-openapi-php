<?php
namespace tpaySDK\Model\Objects\Authorization;

use tpaySDK\Model\Fields\ApiCredentials\Scope;
use tpaySDK\Model\Fields\Token\AccessToken;
use tpaySDK\Model\Fields\Token\ExpiresIn;
use tpaySDK\Model\Fields\Token\IssuedAt;
use tpaySDK\Model\Fields\Token\TokenType;
use tpaySDK\Model\Identifiers\ClientId;
use tpaySDK\Model\Objects\ObjectHelper;
use tpaySDK\Model\Objects\Objects;

class Token extends Objects
{
    use ObjectHelper;

    const OBJECT_FIELDS = [
        'issued_at' => IssuedAt::class,
        'scope' => Scope::class,
        'expires_in' => ExpiresIn::class,
        'token_type' => TokenType::class,
        'client_id' => ClientId::class,
        'access_token' => AccessToken::class,
    ];

    /**
     * @var IssuedAt
     */
    public $issued_at;

    /**
     * @var Scope
     */
    public $scope;

    /**
     * @var ExpiresIn
     */
    public $expires_in;

    /**
     * @var TokenType
     */
    public $token_type;

    /**
     * @var ClientId
     */
    public $client_id;

    /**
     * @var AccessToken
     */
    public $access_token;

}
