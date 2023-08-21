<?php

namespace Tpay\OpenApi\Model\Objects\Authorization;

use Tpay\OpenApi\Model\Fields\ApiCredentials\Scope;
use Tpay\OpenApi\Model\Fields\Token\AccessToken;
use Tpay\OpenApi\Model\Fields\Token\ExpiresIn;
use Tpay\OpenApi\Model\Fields\Token\IssuedAt;
use Tpay\OpenApi\Model\Fields\Token\TokenType;
use Tpay\OpenApi\Model\Identifiers\ClientId;
use Tpay\OpenApi\Model\Objects\Objects;

class Token extends Objects
{
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
