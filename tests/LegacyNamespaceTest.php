<?php

namespace Tpay\OpenApi\Tests;

use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * @coversNothing
 */
class LegacyNamespaceTest extends TestCase
{
    /** @runInSeparateProcess */
    public function testUsingNewNamespaceDoesNotTriggerDeprecation()
    {
        $this->addToAssertionCount(1);

        new \Tpay\OpenApi\Model\Fields\Person\Name();
    }

    /** @runInSeparateProcess */
    public function testUsingOldNamespaceDoesTriggerDeprecation()
    {
        set_error_handler(static function ($errno, $errstr) {
            restore_error_handler();
            throw new RuntimeException($errstr);
        }, E_USER_DEPRECATED);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Using "tpaySDK*" namespace is deprecated and will be removed in 2.0.0');

        new \tpaySDK\Model\Fields\Person\Name();
    }

    public function testClassesExist()
    {
        foreach (self::getLegacyClassNamesFromArray() as $className) {
            self::assertTrue(
                class_exists($className) || interface_exists($className) || trait_exists($className),
                sprintf('Class, interface or trait %s not found.', $className)
            );
        }
    }

    /** @return array<string> */
    private static function getLegacyClassNamesFromArray()
    {
        return [
            'tpaySDK\\Api\\Accounts\\AccountsApi',
            'tpaySDK\\Api\\ApiAction',
            'tpaySDK\\Api\\Authorization\\AuthorizationApi',
            'tpaySDK\\Api\\Refunds\\RefundsApi',
            'tpaySDK\\Api\\TpayApi',
            'tpaySDK\\Api\\Transactions\\TransactionsApi',
            'tpaySDK\\Curl\\Curl',
            'tpaySDK\\Curl\\CurlOptions',
            'tpaySDK\\Dictionary\\HttpCodesDictionary',
            'tpaySDK\\Dictionary\\NotificationsIP',
            'tpaySDK\\Forms\\PaymentForms',
            'tpaySDK\\Loader',
            'tpaySDK\\Locale\\English',
            'tpaySDK\\Locale\\Keys',
            'tpaySDK\\Locale\\Lang',
            'tpaySDK\\Locale\\Polish',
            'tpaySDK\\Manager\\Manager',
            'tpaySDK\\Model\\Fields\\Account\\Krs',
            'tpaySDK\\Model\\Fields\\Account\\LegalForm',
            'tpaySDK\\Model\\Fields\\Account\\NotifyByEmail',
            'tpaySDK\\Model\\Fields\\Account\\OfferCode',
            'tpaySDK\\Model\\Fields\\Account\\Regon',
            'tpaySDK\\Model\\Fields\\Account\\TaxId',
            'tpaySDK\\Model\\Fields\\Account\\VerificationStatus',
            'tpaySDK\\Model\\Fields\\Address\\City',
            'tpaySDK\\Model\\Fields\\Address\\Country',
            'tpaySDK\\Model\\Fields\\Address\\Description',
            'tpaySDK\\Model\\Fields\\Address\\FriendlyName',
            'tpaySDK\\Model\\Fields\\Address\\HouseNumber',
            'tpaySDK\\Model\\Fields\\Address\\IsCorrespondence',
            'tpaySDK\\Model\\Fields\\Address\\IsInvoice',
            'tpaySDK\\Model\\Fields\\Address\\IsMain',
            'tpaySDK\\Model\\Fields\\Address\\Name',
            'tpaySDK\\Model\\Fields\\Address\\Phone',
            'tpaySDK\\Model\\Fields\\Address\\PostalCode',
            'tpaySDK\\Model\\Fields\\Address\\RoomNumber',
            'tpaySDK\\Model\\Fields\\Address\\Street',
            'tpaySDK\\Model\\Fields\\Alias\\Key',
            'tpaySDK\\Model\\Fields\\Alias\\Label',
            'tpaySDK\\Model\\Fields\\Alias\\Type',
            'tpaySDK\\Model\\Fields\\Alias\\Value',
            'tpaySDK\\Model\\Fields\\ApiCredentials\\ClientSecret',
            'tpaySDK\\Model\\Fields\\ApiCredentials\\GrantType',
            'tpaySDK\\Model\\Fields\\ApiCredentials\\Scope',
            'tpaySDK\\Model\\Fields\\Beneficiary\\AccountNumber',
            'tpaySDK\\Model\\Fields\\Beneficiary\\BankName',
            'tpaySDK\\Model\\Fields\\Beneficiary\\Nationality',
            'tpaySDK\\Model\\Fields\\Beneficiary\\PercentageShares',
            'tpaySDK\\Model\\Fields\\Beneficiary\\Swift',
            'tpaySDK\\Model\\Fields\\BlikPaymentData\\BlikToken',
            'tpaySDK\\Model\\Fields\\BlikPaymentData\\Type',
            'tpaySDK\\Model\\Fields\\CardPaymentData\\Card',
            'tpaySDK\\Model\\Fields\\CardPaymentData\\CardToken',
            'tpaySDK\\Model\\Fields\\CardPaymentData\\PreauthorizedToken',
            'tpaySDK\\Model\\Fields\\CardPaymentData\\Save',
            'tpaySDK\\Model\\Fields\\CardPaymentData\\Token',
            'tpaySDK\\Model\\Fields\\Field',
            'tpaySDK\\Model\\Fields\\FieldTypes',
            'tpaySDK\\Model\\Fields\\FieldValidator',
            'tpaySDK\\Model\\Fields\\IdentityDocument\\Details',
            'tpaySDK\\Model\\Fields\\Notification\\CardToken',
            'tpaySDK\\Model\\Fields\\Notification\\Crc',
            'tpaySDK\\Model\\Fields\\Notification\\Description',
            'tpaySDK\\Model\\Fields\\Notification\\Email',
            'tpaySDK\\Model\\Fields\\Notification\\Error',
            'tpaySDK\\Model\\Fields\\Notification\\Masterpass',
            'tpaySDK\\Model\\Fields\\Notification\\Md5sum',
            'tpaySDK\\Model\\Fields\\Notification\\MerchantId',
            'tpaySDK\\Model\\Fields\\Notification\\Paid',
            'tpaySDK\\Model\\Fields\\Notification\\TestMode',
            'tpaySDK\\Model\\Fields\\Notification\\TransactionAmount',
            'tpaySDK\\Model\\Fields\\Notification\\TransactionChannel',
            'tpaySDK\\Model\\Fields\\Notification\\TransactionDate',
            'tpaySDK\\Model\\Fields\\Notification\\TransactionId',
            'tpaySDK\\Model\\Fields\\Notification\\TransactionStatus',
            'tpaySDK\\Model\\Fields\\Notification\\Wallet',
            'tpaySDK\\Model\\Fields\\Pay\\ApplePayPaymentData',
            'tpaySDK\\Model\\Fields\\Pay\\GooglePayPaymentData',
            'tpaySDK\\Model\\Fields\\Pay\\Method',
            'tpaySDK\\Model\\Fields\\Payer\\Address',
            'tpaySDK\\Model\\Fields\\Payer\\Name',
            'tpaySDK\\Model\\Fields\\PersonContact\\Contact',
            'tpaySDK\\Model\\Fields\\PersonContact\\Type',
            'tpaySDK\\Model\\Fields\\Person\\CountryOfBirth',
            'tpaySDK\\Model\\Fields\\Person\\DateOfBirth',
            'tpaySDK\\Model\\Fields\\Person\\Email',
            'tpaySDK\\Model\\Fields\\Person\\ExpiryDate',
            'tpaySDK\\Model\\Fields\\Person\\IsAuthorizedPerson',
            'tpaySDK\\Model\\Fields\\Person\\IsBeneficiary',
            'tpaySDK\\Model\\Fields\\Person\\IsContactPerson',
            'tpaySDK\\Model\\Fields\\Person\\IsRepresentative',
            'tpaySDK\\Model\\Fields\\Person\\IssuingAuthority',
            'tpaySDK\\Model\\Fields\\Person\\Name',
            'tpaySDK\\Model\\Fields\\Person\\PepStatement',
            'tpaySDK\\Model\\Fields\\Person\\Pesel',
            'tpaySDK\\Model\\Fields\\Person\\SerialNumber',
            'tpaySDK\\Model\\Fields\\Person\\SharesPct',
            'tpaySDK\\Model\\Fields\\Person\\Surname',
            'tpaySDK\\Model\\Fields\\Person\\TypeOfDocument',
            'tpaySDK\\Model\\Fields\\PointOfSaleDate\\Create',
            'tpaySDK\\Model\\Fields\\PointOfSaleDate\\Modification',
            'tpaySDK\\Model\\Fields\\PointOfSaleSettings\\ConfirmationCode',
            'tpaySDK\\Model\\Fields\\PointOfSaleSettings\\IsTestMode',
            'tpaySDK\\Model\\Fields\\PointOfSale\\Name',
            'tpaySDK\\Model\\Fields\\PointOfSale\\Url',
            'tpaySDK\\Model\\Fields\\Recursive\\ExpirationDate',
            'tpaySDK\\Model\\Fields\\Recursive\\Period',
            'tpaySDK\\Model\\Fields\\Recursive\\Quantity',
            'tpaySDK\\Model\\Fields\\Recursive\\Type',
            'tpaySDK\\Model\\Fields\\Token\\AccessToken',
            'tpaySDK\\Model\\Fields\\Token\\ExpiresIn',
            'tpaySDK\\Model\\Fields\\Token\\IssuedAt',
            'tpaySDK\\Model\\Fields\\Token\\TokenType',
            'tpaySDK\\Model\\Fields\\Transaction\\Amount',
            'tpaySDK\\Model\\Fields\\Transaction\\Country',
            'tpaySDK\\Model\\Fields\\Transaction\\Description',
            'tpaySDK\\Model\\Fields\\Transaction\\HiddenDescription',
            'tpaySDK\\Model\\Fields\\Transaction\\Lang',
            'tpaySDK\\Model\\Identifiers\\AccountId',
            'tpaySDK\\Model\\Identifiers\\AddressId',
            'tpaySDK\\Model\\Identifiers\\BeneficiaryId',
            'tpaySDK\\Model\\Identifiers\\CategoryId',
            'tpaySDK\\Model\\Identifiers\\ChannelId',
            'tpaySDK\\Model\\Identifiers\\ClientId',
            'tpaySDK\\Model\\Identifiers\\GroupId',
            'tpaySDK\\Model\\Identifiers\\PersonId',
            'tpaySDK\\Model\\Identifiers\\PosId',
            'tpaySDK\\Model\\Identifiers\\RepresentativeId',
            'tpaySDK\\Model\\Identifiers\\TypeId',
            'tpaySDK\\Model\\Objects\\Accounts\\Address',
            'tpaySDK\\Model\\Objects\\Accounts\\Person',
            'tpaySDK\\Model\\Objects\\Accounts\\PersonContact',
            'tpaySDK\\Model\\Objects\\Accounts\\PointOfSale',
            'tpaySDK\\Model\\Objects\\Accounts\\PointOfSaleDate',
            'tpaySDK\\Model\\Objects\\Accounts\\PointOfSaleSettings',
            'tpaySDK\\Model\\Objects\\Authorization\\Token',
            'tpaySDK\\Model\\Objects\\NotificationBody\\BasicPayment',
            'tpaySDK\\Model\\Objects\\Objects',
            'tpaySDK\\Model\\Objects\\ObjectsInterface',
            'tpaySDK\\Model\\Objects\\ObjectsValidator',
            'tpaySDK\\Model\\Objects\\RequestBody\\Account',
            'tpaySDK\\Model\\Objects\\RequestBody\\Auth',
            'tpaySDK\\Model\\Objects\\RequestBody\\BasicAuth',
            'tpaySDK\\Model\\Objects\\RequestBody\\Pay',
            'tpaySDK\\Model\\Objects\\RequestBody\\PayWithInstantRedirection',
            'tpaySDK\\Model\\Objects\\RequestBody\\Refund',
            'tpaySDK\\Model\\Objects\\RequestBody\\Transaction',
            'tpaySDK\\Model\\Objects\\RequestBody\\TransactionWithInstantRedirection',
            'tpaySDK\\Model\\Objects\\Transactions\\Alias',
            'tpaySDK\\Model\\Objects\\Transactions\\BlikPaymentData',
            'tpaySDK\\Model\\Objects\\Transactions\\Callbacks',
            'tpaySDK\\Model\\Objects\\Transactions\\CallbacksNotification',
            'tpaySDK\\Model\\Objects\\Transactions\\CallbacksPayerUrls',
            'tpaySDK\\Model\\Objects\\Transactions\\CardPaymentData',
            'tpaySDK\\Model\\Objects\\Transactions\\Payer',
            'tpaySDK\\Model\\Objects\\Transactions\\Recursive',
            'tpaySDK\\Model\\Objects\\Transactions\\Verification',
            'tpaySDK\\Model\\Objects\\Transactions\\VerificationData',
            'tpaySDK\\Utilities\\Logger',
            'tpaySDK\\Utilities\\ServerValidator',
            'tpaySDK\\Utilities\\TpayException',
            'tpaySDK\\Utilities\\Util',
            'tpaySDK\\Utilities\\phpseclib\\Crypt\\RSA',
            'tpaySDK\\Utilities\\phpseclib\\File\\X509',
            'tpaySDK\\Webhook\\JWSVerifiedPaymentNotification',
            'tpaySDK\\Webhook\\Notification',
            'tpaySDK\\Webhook\\PaymentNotification',
        ];
    }
}
