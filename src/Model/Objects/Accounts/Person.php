<?php

namespace Tpay\OpenApi\Model\Objects\Accounts;

use Tpay\OpenApi\Model\Fields\Beneficiary\Nationality;
use Tpay\OpenApi\Model\Fields\Person\CountryOfBirth;
use Tpay\OpenApi\Model\Fields\Person\DateOfBirth;
use Tpay\OpenApi\Model\Fields\Person\ExpiryDate;
use Tpay\OpenApi\Model\Fields\Person\IsAuthorizedPerson;
use Tpay\OpenApi\Model\Fields\Person\IsBeneficiary;
use Tpay\OpenApi\Model\Fields\Person\IsContactPerson;
use Tpay\OpenApi\Model\Fields\Person\IsRepresentative;
use Tpay\OpenApi\Model\Fields\Person\IssuingAuthority;
use Tpay\OpenApi\Model\Fields\Person\Name;
use Tpay\OpenApi\Model\Fields\Person\PepStatement;
use Tpay\OpenApi\Model\Fields\Person\Pesel;
use Tpay\OpenApi\Model\Fields\Person\SerialNumber;
use Tpay\OpenApi\Model\Fields\Person\SharesPct;
use Tpay\OpenApi\Model\Fields\Person\Surname;
use Tpay\OpenApi\Model\Fields\Person\TypeOfDocument;
use Tpay\OpenApi\Model\Objects\Objects;

class Person extends Objects
{
    public const OBJECT_FIELDS = [
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

    /** @var Name */
    public $name;

    /** @var Surname */
    public $surname;

    /** @var Nationality */
    public $nationality;

    /** @var SharesPct */
    public $sharesPct;

    /** @var Pesel */
    public $pesel;

    /** @var IsBeneficiary */
    public $isBeneficiary;

    /** @var IsRepresentative */
    public $isRepresentative;

    /** @var IsContactPerson */
    public $isContactPerson;

    /** @var IsAuthorizedPerson */
    public $isAuthorizedPerson;

    /** @var PepStatement */
    public $pepStatement;

    /** @var DateOfBirth */
    public $dateOfBirth;

    /** @var CountryOfBirth */
    public $countryOfBirth;

    /** @var TypeOfDocument */
    public $typeOfDocument;

    /** @var SerialNumber */
    public $serialNumber;

    /** @var ExpiryDate */
    public $expiryDate;

    /** @var IssuingAuthority */
    public $issuingAuthority;

    /** @var PersonContact */
    public $contact;
}
