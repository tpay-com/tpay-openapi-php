<?php

namespace Tpay\OpenApi\Model\Objects\Merchant;

use Tpay\OpenApi\Model\Fields\PointOfSale\Name;
use Tpay\OpenApi\Model\Fields\PointOfSale\Url;
use Tpay\OpenApi\Model\Objects\Objects;

class PointOfSale extends Objects
{
    const OBJECT_FIELDS = [
        'name' => Name::class,
        'url' => Url::class,
    ];

    /** @var Name */
    public $name;

    /** @var Url */
    public $url;

    public function getRequiredFields()
    {
        return [
            $this->name,
            $this->url,
        ];
    }
}
