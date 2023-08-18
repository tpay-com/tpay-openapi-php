<?php

namespace Tpay\Model\Objects\Transactions;

use Tpay\Model\Fields\Alias\Key;
use Tpay\Model\Fields\Alias\Label;
use Tpay\Model\Fields\Alias\Type;
use Tpay\Model\Fields\Alias\Value;
use Tpay\Model\Objects\Objects;

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
