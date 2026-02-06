<?php

namespace Tpay\OpenApi\Model\Objects\NotificationBody\BlikAlias;

use Tpay\OpenApi\Model\Fields\Notification\BlikAlias\Type;
use Tpay\OpenApi\Model\Fields\Notification\BlikAlias\Value;
use Tpay\OpenApi\Model\Objects\Objects;

class BlikAliasUnregisterItem extends Objects
{
    const OBJECT_FIELDS = [
        'value' => Value::class,
        'type' => Type::class,
    ];

    /** @var Value */
    public $value;

    /** @var Type */
    public $type;

    public function getRequiredFields()
    {
        return [
            $this->value,
            $this->type,
        ];
    }

    public function toArray()
    {
        return [
            'value' => $this->value->getValue(),
            'type' => $this->type->getValue(),
        ];
    }
}