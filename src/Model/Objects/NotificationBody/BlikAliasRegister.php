<?php

namespace Tpay\OpenApi\Model\Objects\NotificationBody;

use Tpay\OpenApi\Model\Fields\Notification\BlikAlias\Event;
use Tpay\OpenApi\Model\Fields\Notification\BlikAlias\ExpirationDate;
use Tpay\OpenApi\Model\Fields\Notification\BlikAlias\Id;
use Tpay\OpenApi\Model\Fields\Notification\BlikAlias\Type;
use Tpay\OpenApi\Model\Fields\Notification\BlikAlias\Value;
use Tpay\OpenApi\Model\Fields\Notification\Md5sum;
use Tpay\OpenApi\Model\Objects\NotificationBody\BlikAlias\BlikAliasRegisterItem;
use Tpay\OpenApi\Model\Objects\Objects;

class BlikAliasRegister extends Objects
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
