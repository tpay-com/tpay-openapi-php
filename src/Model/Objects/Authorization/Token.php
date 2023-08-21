<?php

namespace Tpay\Model\Objects\Authorization;

use Tpay\Model\Fields\ApiCredentials\Scope;
use Tpay\Model\Fields\Token\AccessToken;
use Tpay\Model\Fields\Token\ExpiresIn;
use Tpay\Model\Fields\Token\IssuedAt;
use Tpay\Model\Fields\Token\TokenType;
use Tpay\Model\Identifiers\ClientId;
use Tpay\Model\Objects\Objects;

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
