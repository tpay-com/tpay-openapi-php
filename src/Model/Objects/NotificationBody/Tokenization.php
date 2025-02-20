<?php

namespace Tpay\OpenApi\Model\Objects\NotificationBody;

use Tpay\OpenApi\Model\Fields\Notification\Tokenization\CardBrand;
use Tpay\OpenApi\Model\Fields\Notification\Tokenization\CardTail;
use Tpay\OpenApi\Model\Fields\Notification\Tokenization\Token;
use Tpay\OpenApi\Model\Fields\Notification\Tokenization\TokenExpiryDate;
use Tpay\OpenApi\Model\Fields\Notification\Tokenization\TokenizationId;
use Tpay\OpenApi\Model\Objects\Objects;

class Tokenization extends Objects
{
    const OBJECT_FIELDS = [
        'tokenizationId' => TokenizationId::class,
        'token' => Token::class,
        'cardBrand' => CardBrand::class,
        'cardTail' => CardTail::class,
        'tokenExpiryDate' => TokenExpiryDate::class,
    ];

    /** @var TokenizationId */
    public $tokenizationId;

    /** @var Token */
    public $token;

    /** @var CardBrand */
    public $cardBrand;

    /** @var CardTail */
    public $cardTail;

    /** @var TokenExpiryDate */
    public $tokenExpiryDate;

    public function getRequiredFields()
    {
        return [
            $this->tokenizationId,
            $this->token,
            $this->cardBrand,
            $this->cardTail,
            $this->tokenExpiryDate,
        ];
    }
}