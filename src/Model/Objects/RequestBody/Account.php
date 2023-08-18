<?php

namespace Tpay\Model\Objects\RequestBody;

use Tpay\Model\Fields\Account\Krs;
use Tpay\Model\Fields\Account\LegalForm;
use Tpay\Model\Fields\Account\NotifyByEmail;
use Tpay\Model\Fields\Account\OfferCode;
use Tpay\Model\Fields\Account\Regon;
use Tpay\Model\Fields\Account\TaxId;
use Tpay\Model\Fields\Person\Email;
use Tpay\Model\Identifiers\CategoryId;
use Tpay\Model\Objects\Accounts\Address;
use Tpay\Model\Objects\Accounts\Person;
use Tpay\Model\Objects\Accounts\PointOfSale;
use Tpay\Model\Objects\Objects;

class Account extends Objects
{
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
