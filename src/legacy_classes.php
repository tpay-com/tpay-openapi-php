<?php

namespace tpaySDK {
    class Loader extends \Tpay\Loader {}
}

namespace tpaySDK\Api {
    class ApiAction extends \Tpay\Api\ApiAction {}
    class TpayApi extends \Tpay\Api\TpayApi {}
}

namespace tpaySDK\Api\Accounts {
    class AccountsApi extends \Tpay\Api\Accounts\AccountsApi {}
}

namespace tpaySDK\Api\Authorization {
    class AuthorizationApi extends \Tpay\Api\Authorization\AuthorizationApi {}
}

namespace tpaySDK\Api\Refunds {
    class RefundsApi extends \Tpay\Api\Refunds\RefundsApi {}
}

namespace tpaySDK\Api\Transactions {
    class TransactionsApi extends \Tpay\Api\Transactions\TransactionsApi {}
}

namespace tpaySDK\Curl {
    class Curl extends \Tpay\Curl\Curl {}
    class CurlOptions extends \Tpay\Curl\CurlOptions {}
}

namespace tpaySDK\Dictionary {
    class HttpCodesDictionary extends \Tpay\Dictionary\HttpCodesDictionary {}
    class NotificationsIP extends \Tpay\Dictionary\NotificationsIP {}
}

namespace tpaySDK\Forms {
    class PaymentForms extends \Tpay\Forms\PaymentForms {}
}

namespace tpaySDK\Locale {
    class English extends \Tpay\Locale\English {}
    class Keys extends \Tpay\Locale\Keys {}
    class Lang extends \Tpay\Locale\Lang {}
    class Polish extends \Tpay\Locale\Polish {}
}

namespace tpaySDK\Manager {
    class Manager extends \Tpay\Manager\Manager {}
}

namespace tpaySDK\Model\Fields {
    class Field extends \Tpay\Model\Fields\Field {}
    interface FieldTypes extends \Tpay\Model\Fields\FieldTypes {}
    class FieldValidator extends \Tpay\Model\Fields\FieldValidator {}
}

namespace tpaySDK\Model\Fields\Account {
    class Krs extends \Tpay\Model\Fields\Account\Krs {}
    class LegalForm extends \Tpay\Model\Fields\Account\LegalForm {}
    class NotifyByEmail extends \Tpay\Model\Fields\Account\NotifyByEmail {}
    class OfferCode extends \Tpay\Model\Fields\Account\OfferCode {}
    class Regon extends \Tpay\Model\Fields\Account\Regon {}
    class TaxId extends \Tpay\Model\Fields\Account\TaxId {}
    class VerificationStatus extends \Tpay\Model\Fields\Account\VerificationStatus {}
}

namespace tpaySDK\Model\Fields\Address {
    class City extends \Tpay\Model\Fields\Address\City {}
    class Country extends \Tpay\Model\Fields\Address\Country {}
    class Description extends \Tpay\Model\Fields\Address\Description {}
    class FriendlyName extends \Tpay\Model\Fields\Address\FriendlyName {}
    class HouseNumber extends \Tpay\Model\Fields\Address\HouseNumber {}
    class IsCorrespondence extends \Tpay\Model\Fields\Address\IsCorrespondence {}
    class IsInvoice extends \Tpay\Model\Fields\Address\IsInvoice {}
    class IsMain extends \Tpay\Model\Fields\Address\IsMain {}
    class Name extends \Tpay\Model\Fields\Address\Name {}
    class Phone extends \Tpay\Model\Fields\Address\Phone {}
    class PostalCode extends \Tpay\Model\Fields\Address\PostalCode {}
    class RoomNumber extends \Tpay\Model\Fields\Address\RoomNumber {}
    class Street extends \Tpay\Model\Fields\Address\Street {}
}

namespace tpaySDK\Model\Fields\Alias {
    class Key extends \Tpay\Model\Fields\Alias\Key {}
    class Label extends \Tpay\Model\Fields\Alias\Label {}
    class Type extends \Tpay\Model\Fields\Alias\Type {}
    class Value extends \Tpay\Model\Fields\Alias\Value {}
}

namespace tpaySDK\Model\Fields\ApiCredentials {
    class ClientSecret extends \Tpay\Model\Fields\ApiCredentials\ClientSecret {}
    class GrantType extends \Tpay\Model\Fields\ApiCredentials\GrantType {}
    class Scope extends \Tpay\Model\Fields\ApiCredentials\Scope {}
}

namespace tpaySDK\Model\Fields\Beneficiary {
    class AccountNumber extends \Tpay\Model\Fields\Beneficiary\AccountNumber {}
    class BankName extends \Tpay\Model\Fields\Beneficiary\BankName {}
    class Nationality extends \Tpay\Model\Fields\Beneficiary\Nationality {}
    class PercentageShares extends \Tpay\Model\Fields\Beneficiary\PercentageShares {}
    class Swift extends \Tpay\Model\Fields\Beneficiary\Swift {}
}

namespace tpaySDK\Model\Fields\BlikPaymentData {
    class BlikToken extends \Tpay\Model\Fields\BlikPaymentData\BlikToken {}
    class Type extends \Tpay\Model\Fields\BlikPaymentData\Type {}
}

namespace tpaySDK\Model\Fields\CardPaymentData {
    class Card extends \Tpay\Model\Fields\CardPaymentData\Card {}
    class CardToken extends \Tpay\Model\Fields\CardPaymentData\CardToken {}
    class PreauthorizedToken extends \Tpay\Model\Fields\CardPaymentData\PreauthorizedToken {}
    class Save extends \Tpay\Model\Fields\CardPaymentData\Save {}
    class Token extends \Tpay\Model\Fields\CardPaymentData\Token {}
}

namespace tpaySDK\Model\Fields\IdentityDocument {
    class Details extends \Tpay\Model\Fields\IdentityDocument\Details {}
}

namespace tpaySDK\Model\Fields\Notification {
    class CardToken extends \Tpay\Model\Fields\Notification\CardToken {}
    class Crc extends \Tpay\Model\Fields\Notification\Crc {}
    class Description extends \Tpay\Model\Fields\Notification\Description {}
    class Email extends \Tpay\Model\Fields\Notification\Email {}
    class Error extends \Tpay\Model\Fields\Notification\Error {}
    class Masterpass extends \Tpay\Model\Fields\Notification\Masterpass {}
    class Md5sum extends \Tpay\Model\Fields\Notification\Md5sum {}
    class MerchantId extends \Tpay\Model\Fields\Notification\MerchantId {}
    class Paid extends \Tpay\Model\Fields\Notification\Paid {}
    class TestMode extends \Tpay\Model\Fields\Notification\TestMode {}
    class TransactionAmount extends \Tpay\Model\Fields\Notification\TransactionAmount {}
    class TransactionChannel extends \Tpay\Model\Fields\Notification\TransactionChannel {}
    class TransactionDate extends \Tpay\Model\Fields\Notification\TransactionDate {}
    class TransactionId extends \Tpay\Model\Fields\Notification\TransactionId {}
    class TransactionStatus extends \Tpay\Model\Fields\Notification\TransactionStatus {}
    class Wallet extends \Tpay\Model\Fields\Notification\Wallet {}
}

namespace tpaySDK\Model\Fields\Pay {
    class ApplePayPaymentData extends \Tpay\Model\Fields\Pay\ApplePayPaymentData {}
    class GooglePayPaymentData extends \Tpay\Model\Fields\Pay\GooglePayPaymentData {}
    class Method extends \Tpay\Model\Fields\Pay\Method {}
}

namespace tpaySDK\Model\Fields\Payer {
    class Address extends \Tpay\Model\Fields\Payer\Address {}
    class Name extends \Tpay\Model\Fields\Payer\Name {}
}

namespace tpaySDK\Model\Fields\Person {
    class CountryOfBirth extends \Tpay\Model\Fields\Person\CountryOfBirth {}
    class DateOfBirth extends \Tpay\Model\Fields\Person\DateOfBirth {}
    class Email extends \Tpay\Model\Fields\Person\Email {}
    class ExpiryDate extends \Tpay\Model\Fields\Person\ExpiryDate {}
    class IsAuthorizedPerson extends \Tpay\Model\Fields\Person\IsAuthorizedPerson {}
    class IsBeneficiary extends \Tpay\Model\Fields\Person\IsBeneficiary {}
    class IsContactPerson extends \Tpay\Model\Fields\Person\IsContactPerson {}
    class IsRepresentative extends \Tpay\Model\Fields\Person\IsRepresentative {}
    class IssuingAuthority extends \Tpay\Model\Fields\Person\IssuingAuthority {}
    class Name extends \Tpay\Model\Fields\Person\Name {}
    class PepStatement extends \Tpay\Model\Fields\Person\PepStatement {}
    class Pesel extends \Tpay\Model\Fields\Person\Pesel {}
    class SerialNumber extends \Tpay\Model\Fields\Person\SerialNumber {}
    class SharesPct extends \Tpay\Model\Fields\Person\SharesPct {}
    class Surname extends \Tpay\Model\Fields\Person\Surname {}
    class TypeOfDocument extends \Tpay\Model\Fields\Person\TypeOfDocument {}
}

namespace tpaySDK\Model\Fields\PersonContact {
    class Contact extends \Tpay\Model\Fields\PersonContact\Contact {}
    class Type extends \Tpay\Model\Fields\PersonContact\Type {}
}

namespace tpaySDK\Model\Fields\PointOfSale {
    class Name extends \Tpay\Model\Fields\PointOfSale\Name {}
    class Url extends \Tpay\Model\Fields\PointOfSale\Url {}
}

namespace tpaySDK\Model\Fields\PointOfSaleDate {
    class Create extends \Tpay\Model\Fields\PointOfSaleDate\Create {}
    class Modification extends \Tpay\Model\Fields\PointOfSaleDate\Modification {}
}

namespace tpaySDK\Model\Fields\PointOfSaleSettings {
    class ConfirmationCode extends \Tpay\Model\Fields\PointOfSaleSettings\ConfirmationCode {}
    class IsTestMode extends \Tpay\Model\Fields\PointOfSaleSettings\IsTestMode {}
}

namespace tpaySDK\Model\Fields\Recursive {
    class ExpirationDate extends \Tpay\Model\Fields\Recursive\ExpirationDate {}
    class Period extends \Tpay\Model\Fields\Recursive\Period {}
    class Quantity extends \Tpay\Model\Fields\Recursive\Quantity {}
    class Type extends \Tpay\Model\Fields\Recursive\Type {}
}

namespace tpaySDK\Model\Fields\Token {
    class AccessToken extends \Tpay\Model\Fields\Token\AccessToken {}
    class ExpiresIn extends \Tpay\Model\Fields\Token\ExpiresIn {}
    class IssuedAt extends \Tpay\Model\Fields\Token\IssuedAt {}
    class TokenType extends \Tpay\Model\Fields\Token\TokenType {}
}

namespace tpaySDK\Model\Fields\Transaction {
    class Amount extends \Tpay\Model\Fields\Transaction\Amount {}
    class Country extends \Tpay\Model\Fields\Transaction\Country {}
    class Description extends \Tpay\Model\Fields\Transaction\Description {}
    class HiddenDescription extends \Tpay\Model\Fields\Transaction\HiddenDescription {}
    class Lang extends \Tpay\Model\Fields\Transaction\Lang {}
}

namespace tpaySDK\Model\Identifiers {
    class AccountId extends \Tpay\Model\Identifiers\AccountId {}
    class AddressId extends \Tpay\Model\Identifiers\AddressId {}
    class BeneficiaryId extends \Tpay\Model\Identifiers\BeneficiaryId {}
    class CategoryId extends \Tpay\Model\Identifiers\CategoryId {}
    class ChannelId extends \Tpay\Model\Identifiers\ChannelId {}
    class ClientId extends \Tpay\Model\Identifiers\ClientId {}
    class GroupId extends \Tpay\Model\Identifiers\GroupId {}
    class PersonId extends \Tpay\Model\Identifiers\PersonId {}
    class PosId extends \Tpay\Model\Identifiers\PosId {}
    class RepresentativeId extends \Tpay\Model\Identifiers\RepresentativeId {}
    class TypeId extends \Tpay\Model\Identifiers\TypeId {}
}

namespace tpaySDK\Model\Objects {
    class Objects extends \Tpay\Model\Objects\Objects {}
    interface ObjectsInterface extends \Tpay\Model\Objects\ObjectsInterface {}
    class ObjectsValidator extends \Tpay\Model\Objects\ObjectsValidator {}
}

namespace tpaySDK\Model\Objects\Accounts {
    class Address extends \Tpay\Model\Objects\Accounts\Address {}
    class Person extends \Tpay\Model\Objects\Accounts\Person {}
    class PersonContact extends \Tpay\Model\Objects\Accounts\PersonContact {}
    class PointOfSale extends \Tpay\Model\Objects\Accounts\PointOfSale {}
    class PointOfSaleDate extends \Tpay\Model\Objects\Accounts\PointOfSaleDate {}
    class PointOfSaleSettings extends \Tpay\Model\Objects\Accounts\PointOfSaleSettings {}
}

namespace tpaySDK\Model\Objects\Authorization {
    class Token extends \Tpay\Model\Objects\Authorization\Token {}
}

namespace tpaySDK\Model\Objects\NotificationBody {
    class BasicPayment extends \Tpay\Model\Objects\NotificationBody\BasicPayment {}
}

namespace tpaySDK\Model\Objects\RequestBody {
    class Account extends \Tpay\Model\Objects\RequestBody\Account {}
    class Auth extends \Tpay\Model\Objects\RequestBody\Auth {}
    class BasicAuth extends \Tpay\Model\Objects\RequestBody\BasicAuth {}
    class Pay extends \Tpay\Model\Objects\RequestBody\Pay {}
    class PayWithInstantRedirection extends \Tpay\Model\Objects\RequestBody\PayWithInstantRedirection {}
    class Refund extends \Tpay\Model\Objects\RequestBody\Refund {}
    class Transaction extends \Tpay\Model\Objects\RequestBody\Transaction {}
    class TransactionWithInstantRedirection extends \Tpay\Model\Objects\RequestBody\TransactionWithInstantRedirection {}
}

namespace tpaySDK\Model\Objects\Transactions {
    class Alias extends \Tpay\Model\Objects\Transactions\Alias {}
    class BlikPaymentData extends \Tpay\Model\Objects\Transactions\BlikPaymentData {}
    class Callbacks extends \Tpay\Model\Objects\Transactions\Callbacks {}
    class CallbacksNotification extends \Tpay\Model\Objects\Transactions\CallbacksNotification {}
    class CallbacksPayerUrls extends \Tpay\Model\Objects\Transactions\CallbacksPayerUrls {}
    class CardPaymentData extends \Tpay\Model\Objects\Transactions\CardPaymentData {}
    class Payer extends \Tpay\Model\Objects\Transactions\Payer {}
    class Recursive extends \Tpay\Model\Objects\Transactions\Recursive {}
    class Verification extends \Tpay\Model\Objects\Transactions\Verification {}
    class VerificationData extends \Tpay\Model\Objects\Transactions\VerificationData {}
}

namespace tpaySDK\Utilities {
    class Logger extends \Tpay\Utilities\Logger {}
    class ServerValidator extends \Tpay\Utilities\ServerValidator {}
    class TpayException extends \Tpay\Utilities\TpayException {}
    class Util extends \Tpay\Utilities\Util {}
}

namespace tpaySDK\Utilities\phpseclib\Crypt {
    abstract class RSA extends \Tpay\Utilities\phpseclib\Crypt\RSA {}
}

namespace tpaySDK\Utilities\phpseclib\File {
    class X509 extends \Tpay\Utilities\phpseclib\File\X509 {}
}

namespace tpaySDK\Webhook {
    class JWSVerifiedPaymentNotification extends \Tpay\Webhook\JWSVerifiedPaymentNotification {}
    class Notification extends \Tpay\Webhook\Notification {}
    class PaymentNotification extends \Tpay\Webhook\PaymentNotification {}
}
