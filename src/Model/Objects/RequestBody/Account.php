<?php

namespace Tpay\OpenApi\Model\Objects\RequestBody;

use Tpay\OpenApi\Model\Fields\Account\Krs;
use Tpay\OpenApi\Model\Fields\Account\LegalForm;
use Tpay\OpenApi\Model\Fields\Account\NotifyByEmail;
use Tpay\OpenApi\Model\Fields\Account\OfferCode;
use Tpay\OpenApi\Model\Fields\Account\Regon;
use Tpay\OpenApi\Model\Fields\Account\TaxId;
use Tpay\OpenApi\Model\Fields\Person\Email;
use Tpay\OpenApi\Model\Identifiers\CategoryId;
use Tpay\OpenApi\Model\Objects\Accounts\Address;
use Tpay\OpenApi\Model\Objects\Accounts\Person;
use Tpay\OpenApi\Model\Objects\Accounts\PointOfSale;
use Tpay\OpenApi\Model\Objects\Objects;

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
