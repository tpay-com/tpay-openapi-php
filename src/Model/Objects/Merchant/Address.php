<?php

namespace Tpay\OpenApi\Model\Objects\Merchant;

use Tpay\OpenApi\Model\Fields\Address\FlatNumber;
use Tpay\OpenApi\Model\Objects\Common\AddressFields;
use Tpay\OpenApi\Model\Objects\Common\AddressPropertiesTrait;
use Tpay\OpenApi\Model\Objects\Objects;

class Address extends Objects
{
    use AddressPropertiesTrait;

    const OBJECT_FIELDS = AddressFields::COMMON_FIELDS + ['flatNumber' => FlatNumber::class];

    /** @var FlatNumber */
    public $flatNumber;

    public function getRequiredFields()
    {
        return [
            $this->friendlyName,
            $this->name,
            $this->street,
            $this->houseNumber,
            $this->postalCode,
            $this->city,
            $this->country,
        ];
    }
}
