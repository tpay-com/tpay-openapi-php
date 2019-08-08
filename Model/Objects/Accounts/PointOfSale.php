<?php
namespace tpaySDK\Model\Objects\Accounts;

use tpaySDK\Model\Fields\Address\Description;
use tpaySDK\Model\Fields\Address\FriendlyName;
use tpaySDK\Model\Fields\Address\Name;
use tpaySDK\Model\Fields\PointOfSale\Url;
use tpaySDK\Model\Identifiers\AccountId;
use tpaySDK\Model\Identifiers\PosId;
use tpaySDK\Model\Objects\Objects;

class PointOfSale extends Objects
{
    const OBJECT_FIELDS = [
        'posId' => PosId::class,
        'accountId' => AccountId::class,
        'name' => Name::class,
        'friendlyName' => FriendlyName::class,
        'description' => Description::class,
        'url' => Url::class,
        'date' => PointOfSaleDate::class,
        'settings' => PointOfSaleSettings::class,
    ];

    /**
     * @var PosId
     */
    public $posId;

    /**
     * @var AccountId
     */
    public $accountId;

    /**
     * @var FriendlyName
     */
    public $friendlyName;

    /**
     * @var Name
     */
    public $name;

    /**
     * @var PointOfSaleDate
     */
    public $date;

    /**
     * @var PointOfSaleSettings
     */
    public $settings;

    /**
     * @var Url
     */
    public $url;

    /**
     * @var Description
     */
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
