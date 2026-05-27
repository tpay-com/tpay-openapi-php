<?php

namespace Tpay\OpenApi\Model\Objects\NotificationBody;

use Tpay\OpenApi\Model\Fields\Notification\BlikAlias\ExpirationDate;
use Tpay\OpenApi\Model\Fields\Notification\BlikAlias\Type;
use Tpay\OpenApi\Model\Fields\Notification\BlikAlias\Value;
use Tpay\OpenApi\Model\Objects\Objects;

class AbstractBlikAlias extends Objects
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

    static protected $requiresExpirationDate = false;

    public function getRequiredFields()
    {
        $fields = [
            $this->value,
            $this->type,
        ];
        if (static::$requiresExpirationDate) {
            $fields[] = $this->expirationDate;
        }

        return $fields;
    }

    public function toArray()
    {
        $data = [
            'value' => $this->value->getValue(),
            'type' => $this->type->getValue(),
        ];
        if (static::$requiresExpirationDate) {
            $data['expirationDate'] = $this->expirationDate->getValue();
        }

        return $data;
    }
}
