<?php

namespace Tpay\OpenApi\Model\Objects\Merchant;

use Tpay\OpenApi\Model\Objects\Common\PointOfSaleFields;
use Tpay\OpenApi\Model\Objects\Common\PointOfSalePropertiesTrait;
use Tpay\OpenApi\Model\Objects\Objects;

class PointOfSale extends Objects
{
    use PointOfSalePropertiesTrait;

    const OBJECT_FIELDS = PointOfSaleFields::COMMON_FIELDS;

    public function getRequiredFields()
    {
        return [
            $this->name,
            $this->url,
        ];
    }
}
