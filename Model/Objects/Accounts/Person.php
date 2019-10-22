<?php
namespace tpaySDK\Model\Objects\Accounts;

use tpaySDK\Model\Fields\Person\Name;
use tpaySDK\Model\Fields\Beneficiary\Nationality;
use tpaySDK\Model\Fields\Person\CountryOfBirth;
use tpaySDK\Model\Fields\Person\DateOfBirth;
use tpaySDK\Model\Fields\Person\ExpiryDate;
use tpaySDK\Model\Fields\Person\IsAuthorizedPerson;
use tpaySDK\Model\Fields\Person\IsBeneficiary;
use tpaySDK\Model\Fields\Person\IsContactPerson;
use tpaySDK\Model\Fields\Person\IsRepresentative;
use tpaySDK\Model\Fields\Person\IssuingAuthority;
use tpaySDK\Model\Fields\Person\PepStatement;
use tpaySDK\Model\Fields\Person\Pesel;
use tpaySDK\Model\Fields\Person\SerialNumber;
use tpaySDK\Model\Fields\Person\SharesPct;
use tpaySDK\Model\Fields\Person\Surname;
use tpaySDK\Model\Fields\Person\TypeOfDocument;
use tpaySDK\Model\Objects\Objects;

class Person extends Objects
{
    const OBJECT_FIELDS = [
        'name' => Name::class,
        'surname' => Surname::class,
        'nationality' => Nationality::class,
        'sharesPct' => SharesPct::class,
        'pesel' => Pesel::class,
        'isBeneficiary' => IsBeneficiary::class,
        'isRepresentative' => IsRepresentative::class,
        'isContactPerson' => IsContactPerson::class,
        'isAuthorizedPerson' => IsAuthorizedPerson::class,
        'pepStatement' => PepStatement::class,
        'dateOfBirth' => DateOfBirth::class,
        'countryOfBirth' => CountryOfBirth::class,
        'typeOfDocument' => TypeOfDocument::class,
        'serialNumber' => SerialNumber::class,
        'expiryDate' => ExpiryDate::class,
        'issuingAuthority' => IssuingAuthority::class,
        'contact' => [PersonContact::class],
    ];

    /**
     * @var Name
     */
    public $name;

    /**
     * @var Surname
     */
    public $surname;

    /**
     * @var Nationality
     */
    public $nationality;

    /**
     * @var SharesPct
     */
    public $sharesPct;

    /**
     * @var Pesel
     */
    public $pesel;

    /**
     * @var IsBeneficiary
     */
    public $isBeneficiary;

    /**
     * @var IsRepresentative
     */
    public $isRepresentative;

    /**
     * @var IsContactPerson
     */
    public $isContactPerson;

    /**
     * @var IsAuthorizedPerson
     */
    public $isAuthorizedPerson;

    /**
     * @var PepStatement
     */
    public $pepStatement;

    /**
     * @var DateOfBirth
     */
    public $dateOfBirth;

    /**
     * @var CountryOfBirth
     */
    public $countryOfBirth;

    /**
     * @var TypeOfDocument
     */
    public $typeOfDocument;

    /**
     * @var SerialNumber
     */
    public $serialNumber;

    /**
     * @var ExpiryDate
     */
    public $expiryDate;

    /**
     * @var IssuingAuthority
     */
    public $issuingAuthority;

    /**
     * @var PersonContact
     */
    public $contact;

}
