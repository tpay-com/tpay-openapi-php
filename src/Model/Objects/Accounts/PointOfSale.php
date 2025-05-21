<?php

namespace Tpay\OpenApi\Model\Objects\Accounts;

use Tpay\OpenApi\Model\Fields\Address\Description;
use Tpay\OpenApi\Model\Fields\Address\FriendlyName;
use Tpay\OpenApi\Model\Fields\PointOfSale\Name;
use Tpay\OpenApi\Model\Fields\PointOfSale\Url;
use Tpay\OpenApi\Model\Identifiers\AccountId;
use Tpay\OpenApi\Model\Identifiers\PosId;
use Tpay\OpenApi\Model\Objects\Objects;

class PointOfSale extends Objects
{
    public const OBJECT_FIELDS = [
        'posId' => PosId::class,
        'accountId' => AccountId::class,
        'name' => Name::class,
        'friendlyName' => FriendlyName::class,
        'description' => Description::class,
        'url' => Url::class,
        'date' => PointOfSaleDate::class,
        'settings' => PointOfSaleSettings::class,
    ];

    /** @var PosId */
    public $posId;

    /** @var AccountId */
    public $accountId;

    /** @var FriendlyName */
    public $friendlyName;

    /** @var Name */
    public $name;

    /** @var PointOfSaleDate */
    public $date;

    /** @var PointOfSaleSettings */
    public $settings;

    /** @var Url */
    public $url;

    /** @var Description */
    public $description;

    public function getRequiredFields()
    {
        return [
            $this->name,
            $this->description,
            $this->url,
        ];
    }
}
