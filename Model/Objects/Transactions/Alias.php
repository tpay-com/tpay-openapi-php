<?php

namespace tpaySDK\Model\Objects\Transactions;

use tpaySDK\Model\Fields\Alias\Key;
use tpaySDK\Model\Fields\Alias\Label;
use tpaySDK\Model\Fields\Alias\Type;
use tpaySDK\Model\Fields\Alias\Value;
use tpaySDK\Model\Objects\Objects;

class Alias extends Objects
{
    const OBJECT_FIELDS = [
        'value' => Value::class,
        'type' => Type::class,
        'label' => Label::class,
        'key' => Key::class,
    ];

    /**
     * @var Value
     */
    public $value;

    /**
     * @var Type
     */
    public $type;

    /**
     * @var Label
     */
    public $label;

    /**
     * @var Key
     */
    public $key;

    public function getRequiredFields()
    {
        return [
            $this->value,
            $this->type,
        ];
    }
}
