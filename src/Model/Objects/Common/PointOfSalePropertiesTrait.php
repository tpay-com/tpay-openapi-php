<?php

namespace Tpay\OpenApi\Model\Objects\Common;

use Tpay\OpenApi\Model\Fields\Address\Description;
use Tpay\OpenApi\Model\Fields\Address\FriendlyName;
use Tpay\OpenApi\Model\Fields\PointOfSale\Name;
use Tpay\OpenApi\Model\Fields\PointOfSale\Url;
use Tpay\OpenApi\Model\Identifiers\AccountId;
use Tpay\OpenApi\Model\Identifiers\PosId;

trait PointOfSalePropertiesTrait
{
    /** @var PosId */
    public $posId;

    /** @var AccountId */
    public $accountId;

    /** @var FriendlyName */
    public $friendlyName;

    /** @var Name */
    public $name;

    /** @var Url */
    public $url;

    /** @var Description */
    public $description;
}
