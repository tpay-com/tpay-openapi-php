<?php

namespace Tpay\Model\Objects\Transactions;

use Tpay\Model\Fields\CardPaymentData\Card;
use Tpay\Model\Fields\CardPaymentData\PreauthorizedToken;
use Tpay\Model\Fields\CardPaymentData\Save;
use Tpay\Model\Fields\CardPaymentData\Token;
use Tpay\Model\Objects\Objects;

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
