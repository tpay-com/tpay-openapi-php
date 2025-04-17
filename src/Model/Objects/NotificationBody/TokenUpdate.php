<?php

namespace Tpay\OpenApi\Model\Objects\NotificationBody;

use Tpay\OpenApi\Model\Fields\Notification\Tokenization\Token;
use Tpay\OpenApi\Model\Objects\Objects;

class TokenUpdate extends Objects
{
    const OBJECT_FIELDS = [
        'token' => Token::class,
    ];

    /** @var Token */
    public $token;

    public function getRequiredFields()
    {
        return [
            $this->token,
        ];
    }
}
