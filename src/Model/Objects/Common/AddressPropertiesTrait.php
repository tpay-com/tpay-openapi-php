<?php

namespace Tpay\OpenApi\Model\Objects\Common;

use Tpay\OpenApi\Model\Fields\Address\City;
use Tpay\OpenApi\Model\Fields\Address\Country;
use Tpay\OpenApi\Model\Fields\Address\FriendlyName;
use Tpay\OpenApi\Model\Fields\Address\HouseNumber;
use Tpay\OpenApi\Model\Fields\Address\IsCorrespondence;
use Tpay\OpenApi\Model\Fields\Address\IsInvoice;
use Tpay\OpenApi\Model\Fields\Address\IsMain;
use Tpay\OpenApi\Model\Fields\Address\Name;
use Tpay\OpenApi\Model\Fields\Address\Phone;
use Tpay\OpenApi\Model\Fields\Address\PostalCode;
use Tpay\OpenApi\Model\Fields\Address\Street;

trait AddressPropertiesTrait
{
    /** @var City */
    public $city;

    /** @var Country */
    public $country;

    /** @var FriendlyName */
    public $friendlyName;

    /** @var HouseNumber */
    public $houseNumber;

    /** @var IsCorrespondence */
    public $isCorrespondence;

    /** @var IsInvoice */
    public $isInvoice;

    /** @var IsMain */
    public $isMain;

    /** @var Name */
    public $name;

    /** @var Phone */
    public $phone;

    /** @var PostalCode */
    public $postalCode;

    /** @var Street */
    public $street;
}
