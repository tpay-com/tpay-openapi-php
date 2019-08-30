<?php
namespace tpaySDK\Model\Objects\Transactions;

use tpaySDK\Model\Fields\CardPaymentData\Card;
use tpaySDK\Model\Fields\CardPaymentData\Token;
use tpaySDK\Model\Fields\CardPaymentData\PreauthorizedToken;
use tpaySDK\Model\Fields\CardPaymentData\Save;
use tpaySDK\Model\Objects\Objects;

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
