<?php

namespace Tpay\OpenApi\Model\Objects\Transactions;

use Tpay\OpenApi\Model\Fields\CardPaymentData\Card;
use Tpay\OpenApi\Model\Fields\CardPaymentData\PreauthorizedToken;
use Tpay\OpenApi\Model\Fields\CardPaymentData\Save;
use Tpay\OpenApi\Model\Fields\CardPaymentData\Token;
use Tpay\OpenApi\Model\Objects\Objects;

class CardPaymentData extends Objects
{
    const OBJECT_FIELDS = [
        'card' => Card::class,
        'token' => Token::class,
        'preauthorizedToken' => PreauthorizedToken::class,
        'save' => Save::class,
    ];

    /**
     * @var Card
     */
    public $card;

    /**
     * @var Token
     */
    public $token;

    /**
     * @var PreauthorizedToken
     */
    public $preauthorizedToken;

    /**
     * @var Save
     */
    public $save;
}
