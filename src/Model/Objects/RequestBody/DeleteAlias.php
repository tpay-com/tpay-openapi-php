<?php

namespace Tpay\OpenApi\Model\Objects\RequestBody;

use Tpay\OpenApi\Model\Fields\Alias\Type;
use Tpay\OpenApi\Model\Objects\Objects;

class DeleteAlias extends Objects
{
    const OBJECT_FIELDS = [
        'aliasType' => Type::class,
    ];

    /** @var Type */
    public $aliasType;

    public function getRequiredFields()
    {
        return [
            $this->aliasType,
        ];
    }
}
