<?php

namespace Tpay\OpenApi\Model\Objects\RequestBody;

use Tpay\OpenApi\Model\Fields\Account\Krs;
use Tpay\OpenApi\Model\Fields\Account\LegalForm;
use Tpay\OpenApi\Model\Fields\Account\MerchantApiConsent;
use Tpay\OpenApi\Model\Fields\Account\OfferCode;
use Tpay\OpenApi\Model\Fields\Account\Regon;
use Tpay\OpenApi\Model\Fields\Account\TaxId;
use Tpay\OpenApi\Model\Fields\Person\Email;
use Tpay\OpenApi\Model\Identifiers\CategoryId;
use Tpay\OpenApi\Model\Objects\Merchant\Address;
use Tpay\OpenApi\Model\Objects\Merchant\ContactPerson;
use Tpay\OpenApi\Model\Objects\Merchant\PointOfSale;
use Tpay\OpenApi\Model\Objects\Objects;

class Merchant extends Objects
{
    const OBJECT_FIELDS = [
        'offerCode' => OfferCode::class,
        'email' => Email::class,
        'taxId' => TaxId::class,
        'regon' => Regon::class,
        'krs' => Krs::class,
        'legalForm' => LegalForm::class,
        'categoryId' => CategoryId::class,
        'address' => [Address::class],
        'website' => [PointOfSale::class],
        'contactPerson' => [ContactPerson::class],
        'merchantApiConsent' => MerchantApiConsent::class,
    ];

    /** @var OfferCode */
    public $offerCode;

    /** @var Email */
    public $email;

    /** @var TaxId */
    public $taxId;

    /** @var Regon */
    public $regon;

    /** @var Krs */
    public $krs;

    /** @var LegalForm */
    public $legalForm;

    /** @var CategoryId */
    public $categoryId;

    /** @var Address */
    public $address;

    /** @var PointOfSale */
    public $website;

    /** @var ContactPerson */
    public $contactPerson;

    /** @var MerchantApiConsent */
    public $merchantApiConsent;

    public function getRequiredFields()
    {
        return [
            $this->offerCode,
            $this->email,
            $this->taxId,
            $this->legalForm,
            $this->categoryId,
            $this->address,
            $this->website,
        ];
    }
}
