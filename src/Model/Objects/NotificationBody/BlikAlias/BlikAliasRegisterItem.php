<?php

namespace Tpay\OpenApi\Model\Objects\NotificationBody\BlikAlias;

use Tpay\OpenApi\Model\Fields\Notification\BlikAlias\ExpirationDate;
use Tpay\OpenApi\Model\Fields\Notification\BlikAlias\Type;
use Tpay\OpenApi\Model\Fields\Notification\BlikAlias\Value;
use Tpay\OpenApi\Model\Objects\Objects;

class BlikAliasRegisterItem extends Objects
{
    const OBJECT_FIELDS = [
        'value' => Value::class,
        'type' => Type::class,
        'expirationDate' => ExpirationDate::class,
    ];

    /** @var Value */
    public $value;

    /** @var Type */
    public $type;

    /** @var ExpirationDate */
    public $expirationDate;

    public function getRequiredFields()
    {
        return [
            $this->value,
            $this->type,
            $this->expirationDate,
        ];
    }

    public function toArray()
    {
        return [
            'value' => $this->value->getValue(),
            'type' => $this->type->getValue(),
            'expirationDate' => $this->expirationDate->getValue(),
        ];
    }
}
