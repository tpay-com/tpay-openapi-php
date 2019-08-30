<?php
namespace tpaySDK\Model\Objects\RequestBody;

use tpaySDK\Model\Fields\Account\Krs;
use tpaySDK\Model\Fields\Account\LegalForm;
use tpaySDK\Model\Fields\Account\NotifyByEmail;
use tpaySDK\Model\Fields\Account\OfferCode;
use tpaySDK\Model\Fields\Account\Regon;
use tpaySDK\Model\Fields\Account\TaxId;
use tpaySDK\Model\Objects\ObjectHelper;
use tpaySDK\Model\Fields\Person\Email;
use tpaySDK\Model\Identifiers\CategoryId;
use tpaySDK\Model\Objects\Accounts\Address;
use tpaySDK\Model\Objects\Objects;
use tpaySDK\Model\Objects\Accounts\Person;
use tpaySDK\Model\Objects\Accounts\PointOfSale;

class Account extends Objects
{
    use ObjectHelper;

    const OBJECT_FIELDS = [
        'offerCode' => OfferCode::class,
        'email' => Email::class,
        'taxId' => TaxId::class,
        'regon' => Regon::class,
        'krs' => Krs::class,
        'legalForm' => LegalForm::class,
        'categoryId' => CategoryId::class,
        'notifyByEmail' => NotifyByEmail::class,
        'website' => [PointOfSale::class],
        'address' => [Address::class],
        'person' => [Person::class],
    ];

    /**
     * @var OfferCode
     */
    public $offerCode;

    /**
     * @var Email
     */
    public $email;

    /**
     * @var TaxId
     */
    public $taxId;

    /**
     * @var Regon
     */
    public $regon;

    /**
     * @var Krs
     */
    public $krs;

    /**
     * @var LegalForm
     */
    public $legalForm;

    /**
     * @var CategoryId
     */
    public $categoryId;

    /**
     * @var NotifyByEmail
     */
    public $notifyByEmail;

    /**
     * @var PointOfSale
     */
    public $website;

    /**
     * @var Address
     */
    public $address;

    /**
     * @var Person
     */
    public $person;

    public function getRequiredFields()
    {
        return [
            $this->email,
            $this->taxId,
            $this->offerCode,
            $this->legalForm,
            $this->categoryId,
            $this->website,
            $this->address,
        ];
    }

}
