<?php

namespace tpaySDK {

    @trigger_error('Using "tpaySDK*" namespace is deprecated and will be removed in 2.0.0', E_USER_DEPRECATED);

    class Loader extends \Tpay\OpenApi\Loader
    {
    }
}

namespace tpaySDK\Api {

    class ApiAction extends \Tpay\OpenApi\Api\ApiAction
    {
    }

    class TpayApi extends \Tpay\OpenApi\Api\TpayApi
    {
    }
}

namespace tpaySDK\Api\Accounts {

    class AccountsApi extends \Tpay\OpenApi\Api\Accounts\AccountsApi
    {
    }
}

namespace tpaySDK\Api\Authorization {

    class AuthorizationApi extends \Tpay\OpenApi\Api\Authorization\AuthorizationApi
    {
    }
}

namespace tpaySDK\Api\Refunds {

    class RefundsApi extends \Tpay\OpenApi\Api\Refunds\RefundsApi
    {
    }
}

namespace tpaySDK\Api\Transactions {

    class TransactionsApi extends \Tpay\OpenApi\Api\Transactions\TransactionsApi
    {
    }
}

namespace tpaySDK\Curl {

    class Curl extends \Tpay\OpenApi\Curl\Curl
    {
    }

    class CurlOptions extends \Tpay\OpenApi\Curl\CurlOptions
    {
    }
}

namespace tpaySDK\Dictionary {

    class HttpCodesDictionary extends \Tpay\OpenApi\Dictionary\HttpCodesDictionary
    {
    }

    class NotificationsIP extends \Tpay\OpenApi\Dictionary\NotificationsIP
    {
    }
}

namespace tpaySDK\Forms {

    class PaymentForms extends \Tpay\OpenApi\Forms\PaymentForms
    {
    }
}

namespace tpaySDK\Locale {

    class English extends \Tpay\OpenApi\Locale\English
    {
    }

    class Keys extends \Tpay\OpenApi\Locale\Keys
    {
    }

    class Lang extends \Tpay\OpenApi\Locale\Lang
    {
    }

    class Polish extends \Tpay\OpenApi\Locale\Polish
    {
    }
}

namespace tpaySDK\Manager {

    class Manager extends \Tpay\OpenApi\Manager\Manager
    {
    }
}

namespace tpaySDK\Model\Fields {

    class Field extends \Tpay\OpenApi\Model\Fields\Field
    {
    }

    interface FieldTypes extends \Tpay\OpenApi\Model\Fields\FieldTypes
    {
    }

    class FieldValidator extends \Tpay\OpenApi\Model\Fields\FieldValidator
    {
    }
}

namespace tpaySDK\Model\Fields\Account {

    class Krs extends \Tpay\OpenApi\Model\Fields\Account\Krs
    {
    }

    class LegalForm extends \Tpay\OpenApi\Model\Fields\Account\LegalForm
    {
    }

    class NotifyByEmail extends \Tpay\OpenApi\Model\Fields\Account\NotifyByEmail
    {
    }

    class OfferCode extends \Tpay\OpenApi\Model\Fields\Account\OfferCode
    {
    }

    class Regon extends \Tpay\OpenApi\Model\Fields\Account\Regon
    {
    }

    class TaxId extends \Tpay\OpenApi\Model\Fields\Account\TaxId
    {
    }

    class VerificationStatus extends \Tpay\OpenApi\Model\Fields\Account\VerificationStatus
    {
    }
}

namespace tpaySDK\Model\Fields\Address {

    class City extends \Tpay\OpenApi\Model\Fields\Address\City
    {
    }

    class Country extends \Tpay\OpenApi\Model\Fields\Address\Country
    {
    }

    class Description extends \Tpay\OpenApi\Model\Fields\Address\Description
    {
    }

    class FriendlyName extends \Tpay\OpenApi\Model\Fields\Address\FriendlyName
    {
    }

    class HouseNumber extends \Tpay\OpenApi\Model\Fields\Address\HouseNumber
    {
    }

    class IsCorrespondence extends \Tpay\OpenApi\Model\Fields\Address\IsCorrespondence
    {
    }

    class IsInvoice extends \Tpay\OpenApi\Model\Fields\Address\IsInvoice
    {
    }

    class IsMain extends \Tpay\OpenApi\Model\Fields\Address\IsMain
    {
    }

    class Name extends \Tpay\OpenApi\Model\Fields\Address\Name
    {
    }

    class Phone extends \Tpay\OpenApi\Model\Fields\Address\Phone
    {
    }

    class PostalCode extends \Tpay\OpenApi\Model\Fields\Address\PostalCode
    {
    }

    class RoomNumber extends \Tpay\OpenApi\Model\Fields\Address\RoomNumber
    {
    }

    class Street extends \Tpay\OpenApi\Model\Fields\Address\Street
    {
    }
}

namespace tpaySDK\Model\Fields\Alias {

    class Key extends \Tpay\OpenApi\Model\Fields\Alias\Key
    {
    }

    class Label extends \Tpay\OpenApi\Model\Fields\Alias\Label
    {
    }

    class Type extends \Tpay\OpenApi\Model\Fields\Alias\Type
    {
    }

    class Value extends \Tpay\OpenApi\Model\Fields\Alias\Value
    {
    }
}

namespace tpaySDK\Model\Fields\ApiCredentials {

    class ClientSecret extends \Tpay\OpenApi\Model\Fields\ApiCredentials\ClientSecret
    {
    }

    class GrantType extends \Tpay\OpenApi\Model\Fields\ApiCredentials\GrantType
    {
    }

    class Scope extends \Tpay\OpenApi\Model\Fields\ApiCredentials\Scope
    {
    }
}

namespace tpaySDK\Model\Fields\Beneficiary {

    class AccountNumber extends \Tpay\OpenApi\Model\Fields\Beneficiary\AccountNumber
    {
    }

    class BankName extends \Tpay\OpenApi\Model\Fields\Beneficiary\BankName
    {
    }

    class Nationality extends \Tpay\OpenApi\Model\Fields\Beneficiary\Nationality
    {
    }

    class PercentageShares extends \Tpay\OpenApi\Model\Fields\Beneficiary\PercentageShares
    {
    }

    class Swift extends \Tpay\OpenApi\Model\Fields\Beneficiary\Swift
    {
    }
}

namespace tpaySDK\Model\Fields\BlikPaymentData {

    class BlikToken extends \Tpay\OpenApi\Model\Fields\BlikPaymentData\BlikToken
    {
    }

    class Type extends \Tpay\OpenApi\Model\Fields\BlikPaymentData\Type
    {
    }
}

namespace tpaySDK\Model\Fields\CardPaymentData {

    class Card extends \Tpay\OpenApi\Model\Fields\CardPaymentData\Card
    {
    }

    class CardToken extends \Tpay\OpenApi\Model\Fields\CardPaymentData\CardToken
    {
    }

    class PreauthorizedToken extends \Tpay\OpenApi\Model\Fields\CardPaymentData\PreauthorizedToken
    {
    }

    class Save extends \Tpay\OpenApi\Model\Fields\CardPaymentData\Save
    {
    }

    class Token extends \Tpay\OpenApi\Model\Fields\CardPaymentData\Token
    {
    }
}

namespace tpaySDK\Model\Fields\IdentityDocument {

    class Details extends \Tpay\OpenApi\Model\Fields\IdentityDocument\Details
    {
    }
}

namespace tpaySDK\Model\Fields\Notification {

    class CardToken extends \Tpay\OpenApi\Model\Fields\Notification\CardToken
    {
    }

    class Crc extends \Tpay\OpenApi\Model\Fields\Notification\Crc
    {
    }

    class Description extends \Tpay\OpenApi\Model\Fields\Notification\Description
    {
    }

    class Email extends \Tpay\OpenApi\Model\Fields\Notification\Email
    {
    }

    class Error extends \Tpay\OpenApi\Model\Fields\Notification\Error
    {
    }

    class Masterpass extends \Tpay\OpenApi\Model\Fields\Notification\Masterpass
    {
    }

    class Md5sum extends \Tpay\OpenApi\Model\Fields\Notification\Md5sum
    {
    }

    class MerchantId extends \Tpay\OpenApi\Model\Fields\Notification\MerchantId
    {
    }

    class Paid extends \Tpay\OpenApi\Model\Fields\Notification\Paid
    {
    }

    class TestMode extends \Tpay\OpenApi\Model\Fields\Notification\TestMode
    {
    }

    class TransactionAmount extends \Tpay\OpenApi\Model\Fields\Notification\TransactionAmount
    {
    }

    class TransactionChannel extends \Tpay\OpenApi\Model\Fields\Notification\TransactionChannel
    {
    }

    class TransactionDate extends \Tpay\OpenApi\Model\Fields\Notification\TransactionDate
    {
    }

    class TransactionId extends \Tpay\OpenApi\Model\Fields\Notification\TransactionId
    {
    }

    class TransactionStatus extends \Tpay\OpenApi\Model\Fields\Notification\TransactionStatus
    {
    }

    class Wallet extends \Tpay\OpenApi\Model\Fields\Notification\Wallet
    {
    }
}

namespace tpaySDK\Model\Fields\Pay {

    class ApplePayPaymentData extends \Tpay\OpenApi\Model\Fields\Pay\ApplePayPaymentData
    {
    }

    class GooglePayPaymentData extends \Tpay\OpenApi\Model\Fields\Pay\GooglePayPaymentData
    {
    }

    class Method extends \Tpay\OpenApi\Model\Fields\Pay\Method
    {
    }
}

namespace tpaySDK\Model\Fields\Payer {

    class Address extends \Tpay\OpenApi\Model\Fields\Payer\Address
    {
    }

    class Name extends \Tpay\OpenApi\Model\Fields\Payer\Name
    {
    }
}

namespace tpaySDK\Model\Fields\Person {

    class CountryOfBirth extends \Tpay\OpenApi\Model\Fields\Person\CountryOfBirth
    {
    }

    class DateOfBirth extends \Tpay\OpenApi\Model\Fields\Person\DateOfBirth
    {
    }

    class Email extends \Tpay\OpenApi\Model\Fields\Person\Email
    {
    }

    class ExpiryDate extends \Tpay\OpenApi\Model\Fields\Person\ExpiryDate
    {
    }

    class IsAuthorizedPerson extends \Tpay\OpenApi\Model\Fields\Person\IsAuthorizedPerson
    {
    }

    class IsBeneficiary extends \Tpay\OpenApi\Model\Fields\Person\IsBeneficiary
    {
    }

    class IsContactPerson extends \Tpay\OpenApi\Model\Fields\Person\IsContactPerson
    {
    }

    class IsRepresentative extends \Tpay\OpenApi\Model\Fields\Person\IsRepresentative
    {
    }

    class IssuingAuthority extends \Tpay\OpenApi\Model\Fields\Person\IssuingAuthority
    {
    }

    class Name extends \Tpay\OpenApi\Model\Fields\Person\Name
    {
    }

    class PepStatement extends \Tpay\OpenApi\Model\Fields\Person\PepStatement
    {
    }

    class Pesel extends \Tpay\OpenApi\Model\Fields\Person\Pesel
    {
    }

    class SerialNumber extends \Tpay\OpenApi\Model\Fields\Person\SerialNumber
    {
    }

    class SharesPct extends \Tpay\OpenApi\Model\Fields\Person\SharesPct
    {
    }

    class Surname extends \Tpay\OpenApi\Model\Fields\Person\Surname
    {
    }

    class TypeOfDocument extends \Tpay\OpenApi\Model\Fields\Person\TypeOfDocument
    {
    }
}

namespace tpaySDK\Model\Fields\PersonContact {

    class Contact extends \Tpay\OpenApi\Model\Fields\PersonContact\Contact
    {
    }

    class Type extends \Tpay\OpenApi\Model\Fields\PersonContact\Type
    {
    }
}

namespace tpaySDK\Model\Fields\PointOfSale {

    class Name extends \Tpay\OpenApi\Model\Fields\PointOfSale\Name
    {
    }

    class Url extends \Tpay\OpenApi\Model\Fields\PointOfSale\Url
    {
    }
}

namespace tpaySDK\Model\Fields\PointOfSaleDate {

    class Create extends \Tpay\OpenApi\Model\Fields\PointOfSaleDate\Create
    {
    }

    class Modification extends \Tpay\OpenApi\Model\Fields\PointOfSaleDate\Modification
    {
    }
}

namespace tpaySDK\Model\Fields\PointOfSaleSettings {

    class ConfirmationCode extends \Tpay\OpenApi\Model\Fields\PointOfSaleSettings\ConfirmationCode
    {
    }

    class IsTestMode extends \Tpay\OpenApi\Model\Fields\PointOfSaleSettings\IsTestMode
    {
    }
}

namespace tpaySDK\Model\Fields\Recursive {

    class ExpirationDate extends \Tpay\OpenApi\Model\Fields\Recursive\ExpirationDate
    {
    }

    class Period extends \Tpay\OpenApi\Model\Fields\Recursive\Period
    {
    }

    class Quantity extends \Tpay\OpenApi\Model\Fields\Recursive\Quantity
    {
    }

    class Type extends \Tpay\OpenApi\Model\Fields\Recursive\Type
    {
    }
}

namespace tpaySDK\Model\Fields\Token {

    class AccessToken extends \Tpay\OpenApi\Model\Fields\Token\AccessToken
    {
    }

    class ExpiresIn extends \Tpay\OpenApi\Model\Fields\Token\ExpiresIn
    {
    }

    class IssuedAt extends \Tpay\OpenApi\Model\Fields\Token\IssuedAt
    {
    }

    class TokenType extends \Tpay\OpenApi\Model\Fields\Token\TokenType
    {
    }
}

namespace tpaySDK\Model\Fields\Transaction {

    class Amount extends \Tpay\OpenApi\Model\Fields\Transaction\Amount
    {
    }

    class Country extends \Tpay\OpenApi\Model\Fields\Transaction\Country
    {
    }

    class Description extends \Tpay\OpenApi\Model\Fields\Transaction\Description
    {
    }

    class HiddenDescription extends \Tpay\OpenApi\Model\Fields\Transaction\HiddenDescription
    {
    }

    class Lang extends \Tpay\OpenApi\Model\Fields\Transaction\Lang
    {
    }
}

namespace tpaySDK\Model\Identifiers {

    class AccountId extends \Tpay\OpenApi\Model\Identifiers\AccountId
    {
    }

    class AddressId extends \Tpay\OpenApi\Model\Identifiers\AddressId
    {
    }

    class BeneficiaryId extends \Tpay\OpenApi\Model\Identifiers\BeneficiaryId
    {
    }

    class CategoryId extends \Tpay\OpenApi\Model\Identifiers\CategoryId
    {
    }

    class ChannelId extends \Tpay\OpenApi\Model\Identifiers\ChannelId
    {
    }

    class ClientId extends \Tpay\OpenApi\Model\Identifiers\ClientId
    {
    }

    class GroupId extends \Tpay\OpenApi\Model\Identifiers\GroupId
    {
    }

    class PersonId extends \Tpay\OpenApi\Model\Identifiers\PersonId
    {
    }

    class PosId extends \Tpay\OpenApi\Model\Identifiers\PosId
    {
    }

    class RepresentativeId extends \Tpay\OpenApi\Model\Identifiers\RepresentativeId
    {
    }

    class TypeId extends \Tpay\OpenApi\Model\Identifiers\TypeId
    {
    }
}

namespace tpaySDK\Model\Objects {

    class Objects extends \Tpay\OpenApi\Model\Objects\Objects
    {
    }

    interface ObjectsInterface extends \Tpay\OpenApi\Model\Objects\ObjectsInterface
    {
    }

    class ObjectsValidator extends \Tpay\OpenApi\Model\Objects\ObjectsValidator
    {
    }
}

namespace tpaySDK\Model\Objects\Accounts {

    class Address extends \Tpay\OpenApi\Model\Objects\Accounts\Address
    {
    }

    class Person extends \Tpay\OpenApi\Model\Objects\Accounts\Person
    {
    }

    class PersonContact extends \Tpay\OpenApi\Model\Objects\Accounts\PersonContact
    {
    }

    class PointOfSale extends \Tpay\OpenApi\Model\Objects\Accounts\PointOfSale
    {
    }

    class PointOfSaleDate extends \Tpay\OpenApi\Model\Objects\Accounts\PointOfSaleDate
    {
    }

    class PointOfSaleSettings extends \Tpay\OpenApi\Model\Objects\Accounts\PointOfSaleSettings
    {
    }
}

namespace tpaySDK\Model\Objects\Authorization {

    class Token extends \Tpay\OpenApi\Model\Objects\Authorization\Token
    {
    }
}

namespace tpaySDK\Model\Objects\NotificationBody {

    class BasicPayment extends \Tpay\OpenApi\Model\Objects\NotificationBody\BasicPayment
    {
    }
}

namespace tpaySDK\Model\Objects\RequestBody {

    class Account extends \Tpay\OpenApi\Model\Objects\RequestBody\Account
    {
    }

    class Auth extends \Tpay\OpenApi\Model\Objects\RequestBody\Auth
    {
    }

    class BasicAuth extends \Tpay\OpenApi\Model\Objects\RequestBody\BasicAuth
    {
    }

    class Pay extends \Tpay\OpenApi\Model\Objects\RequestBody\Pay
    {
    }

    class PayWithInstantRedirection extends \Tpay\OpenApi\Model\Objects\RequestBody\PayWithInstantRedirection
    {
    }

    class Refund extends \Tpay\OpenApi\Model\Objects\RequestBody\Refund
    {
    }

    class Transaction extends \Tpay\OpenApi\Model\Objects\RequestBody\Transaction
    {
    }

    class TransactionWithInstantRedirection extends
        \Tpay\OpenApi\Model\Objects\RequestBody\TransactionWithInstantRedirection
    {
    }
}

namespace tpaySDK\Model\Objects\Transactions {

    class Alias extends \Tpay\OpenApi\Model\Objects\Transactions\Alias
    {
    }

    class BlikPaymentData extends \Tpay\OpenApi\Model\Objects\Transactions\BlikPaymentData
    {
    }

    class Callbacks extends \Tpay\OpenApi\Model\Objects\Transactions\Callbacks
    {
    }

    class CallbacksNotification extends \Tpay\OpenApi\Model\Objects\Transactions\CallbacksNotification
    {
    }

    class CallbacksPayerUrls extends \Tpay\OpenApi\Model\Objects\Transactions\CallbacksPayerUrls
    {
    }

    class CardPaymentData extends \Tpay\OpenApi\Model\Objects\Transactions\CardPaymentData
    {
    }

    class Payer extends \Tpay\OpenApi\Model\Objects\Transactions\Payer
    {
    }

    class Recursive extends \Tpay\OpenApi\Model\Objects\Transactions\Recursive
    {
    }
}

namespace tpaySDK\Utilities {

    class Logger extends \Tpay\OpenApi\Utilities\Logger
    {
    }

    class ServerValidator extends \Tpay\OpenApi\Utilities\ServerValidator
    {
    }

    class TpayException extends \Tpay\OpenApi\Utilities\TpayException
    {
    }

    class Util extends \Tpay\OpenApi\Utilities\Util
    {
    }
}

namespace tpaySDK\Utilities\phpseclib\Crypt {

    abstract class RSA extends \Tpay\OpenApi\Utilities\phpseclib\Crypt\RSA
    {
    }
}

namespace tpaySDK\Utilities\phpseclib\File {

    class X509 extends \Tpay\OpenApi\Utilities\phpseclib\File\X509
    {
    }
}

namespace tpaySDK\Webhook {

    class JWSVerifiedPaymentNotification extends \Tpay\OpenApi\Webhook\JWSVerifiedPaymentNotification
    {
    }

    class Notification extends \Tpay\OpenApi\Webhook\Notification
    {
    }

    class PaymentNotification extends \Tpay\OpenApi\Webhook\PaymentNotification
    {
    }
}
