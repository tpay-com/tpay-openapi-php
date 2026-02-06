<?php

namespace Tpay\Tests\OpenApi\Webhook;

use PHPUnit\Framework\TestCase;
use Tpay\OpenApi\Model\Objects\NotificationBody\BasicPayment;
use Tpay\OpenApi\Model\Objects\NotificationBody\BlikAlias\BlikAliasRegisterItem;
use Tpay\OpenApi\Model\Objects\NotificationBody\BlikAlias\BlikAliasUnregisterItem;
use Tpay\OpenApi\Model\Objects\NotificationBody\BlikAliasRegister;
use Tpay\OpenApi\Model\Objects\NotificationBody\BlikAliasUnregister;
use Tpay\OpenApi\Model\Objects\NotificationBody\MarketplaceTransaction;
use Tpay\OpenApi\Model\Objects\NotificationBody\Tokenization;
use Tpay\OpenApi\Model\Objects\NotificationBody\TokenUpdate;
use Tpay\OpenApi\Utilities\TpayException;
use Tpay\OpenApi\Webhook\JWSVerifiedPaymentNotification;
use Tpay\Tests\OpenApi\Mock\CertificateProviderMock;
use Tpay\Tests\OpenApi\Mock\RequestParserMock;

class JWSVerifiedPaymentNotificationTest extends TestCase
{
    const CORRECT_CODE = '1234567890';
    const INVALID_CODE = '0987654321';

    static private $x509 = null;
    static private $privateKey = null;

    /**
     * @dataProvider positiveValidationProvider
     *
     * @param mixed $contentType
     * @param mixed $data
     * @param mixed $payload
     * @param mixed $signature
     * @param mixed $secret
     * @param mixed $productionMode
     * @param mixed $expectedClass
     * @param mixed $fieldName
     * @param mixed $fieldValue
     */
    public function testPositiveValidationCases($contentType, $data, $payload, $signature, $secret, $productionMode, $expectedClass, $fieldName, $fieldValue, $expectedItemClass = null)
    {
        $requestMock = new RequestParserMock($contentType, $data, $payload, $signature);
        $certificateMock = $this->getCertificateMock();

        $notification = new JWSVerifiedPaymentNotification($certificateMock, $secret, $productionMode, $requestMock);

        $notificationObject = $notification->getNotification();

        $this->assertInstanceOf($expectedClass, $notificationObject);

        $field = $notificationObject->{$fieldName};
        if (is_array($field)) {
            $this->assertInstanceOf($expectedItemClass, $field[0]);
            $this->assertEquals($fieldValue, $field[0]->toArray());
        } else {
            $this->assertEquals($field->getValue(), $fieldValue);
        }
    }

    /**
     * @dataProvider negativeValidationProvider
     *
     * @param mixed $contentType
     * @param mixed $data
     * @param mixed $payload
     * @param mixed $signature
     * @param mixed $secret
     * @param mixed $productionMode
     */
    public function testNegativeValidationCases($contentType, $data, $payload, $signature, $secret, $productionMode)
    {
        $this->expectException(TpayException::class);

        $requestMock = new RequestParserMock($contentType, $data, $payload, $signature);
        $certificateMock = $this->getCertificateMock();

        $notification = new JWSVerifiedPaymentNotification($certificateMock, $secret, $productionMode, $requestMock);

        $notification->getNotification();
    }

    public function positiveValidationProvider()
    {
        $result = [];

        $payload = <<<'JSON'
{
  "type": "tokenization",
  "data": {
    "tokenizationId": "TO-1234-890123456789012345678901234567890123456789012345678901234",
    "token": "1234567890123456789012345678901234567890123456789012345678901234",
    "cardBrand": "Mastercard",
    "cardTail": "1111",
    "tokenExpiryDate": "0625"
  }
}
JSON;
        $data = json_decode($payload, true);
        $result[] = ['application/json', $data, $payload, $this->sign($payload, true), 'x', true, Tokenization::class, 'tokenizationId', 'TO-1234-890123456789012345678901234567890123456789012345678901234'];

        $payload = http_build_query($data);
        $result[] = ['application/x-www-form-urlencoded', $data, $payload, $this->sign($payload, true), 'x', true, Tokenization::class, 'tokenizationId', 'TO-1234-890123456789012345678901234567890123456789012345678901234'];

        $payload = <<<'JSON'
{
  "type": "token_update",
  "data": {
    "token": "1234567890123456789012345678901234567890123456789012345678901234"
  }
}
JSON;
        $data = json_decode($payload, true);
        $result[] = ['application/json', $data, $payload, $this->sign($payload, true), 'x', true, TokenUpdate::class, 'token', '1234567890123456789012345678901234567890123456789012345678901234'];

        $payload = http_build_query($data);
        $result[] = ['application/x-www-form-urlencoded', $data, $payload, $this->sign($payload, true), 'x', true, TokenUpdate::class, 'token', '1234567890123456789012345678901234567890123456789012345678901234'];

        $payload = <<<'JSON'
{
  "type": "marketplace_transaction",
  "data": {
    "transactionId": "TO-1234-890123456789012345678901234567890123456789012345678901234",
    "transactionTitle": "Test Transaction 32",
    "transactionAmount": "1234.56",
    "transactionPaidAmount": "1234.56",
    "transactionStatus": "correct",
    "transactionHiddenDescription": "31234",
    "payerEmail": "test@example.com",
    "transactionDate": "2024-12-10 23:23:12",
    "transactionDescription": "Test Transaction",
    "cardToken": "1234567890123456789012345678901234567890"
  }
}
JSON;
        $data = json_decode($payload, true);
        $result[] = ['application/json', $data, $payload, $this->sign($payload, true), 'x', true, MarketplaceTransaction::class, 'transactionId', 'TO-1234-890123456789012345678901234567890123456789012345678901234'];

        $payload = http_build_query($data);
        $result[] = ['application/x-www-form-urlencoded', $data, $payload, $this->sign($payload, true), 'x', true, MarketplaceTransaction::class, 'transactionId', 'TO-1234-890123456789012345678901234567890123456789012345678901234'];

        $id = '12345';
        $tr_id = 'TR-1234-89012345678901234567890';
        $tr_amount = '144.69';
        $tr_crc = uniqid();
        $md5sum = md5($id.$tr_id.$tr_amount.$tr_crc.self::CORRECT_CODE);

        $data = [
            'id' => $id,
            'tr_id' => $tr_id,
            'tr_date' => '2024-12-10 09:27:59',
            'tr_crc' => $tr_crc,
            'tr_amount' => $tr_amount,
            'tr_paid' => $tr_amount,
            'tr_desc' => 'Order #123456',
            'tr_status' => 'PAID',
            'tr_error' => 'none',
            'tr_email' => 'test@example.com',
            'md5sum' => $md5sum,
            'test_mode' => 0,
            'card_token' => '123456789012345678901234567890',
            'token_expiry_date' => '1226',
            'card_tail' => '1111',
            'card_brand' => 'Visa',
        ];
        $payload = http_build_query($data);
        $result[] = ['application/x-www-form-urlencoded', $data, $payload, $this->sign($payload, true), self::CORRECT_CODE, true, BasicPayment::class, 'tr_id', $tr_id];

        $id = '123456';
        $tr_id = 'TR-1234-12012345678901234567890';
        $tr_amount = '543.34';
        $tr_crc = uniqid();
        $md5sum = md5($id.$tr_id.$tr_amount.$tr_crc.self::CORRECT_CODE);

        $data = [
            'id' => $id,
            'tr_id' => $tr_id,
            'tr_date' => '2024-12-10 09:27:59',
            'tr_crc' => $tr_crc,
            'tr_amount' => $tr_amount,
            'tr_paid' => $tr_amount,
            'tr_desc' => 'Test Transaction #123456',
            'tr_status' => 'PAID',
            'tr_error' => 'none',
            'tr_email' => 'test@example.com',
            'md5sum' => $md5sum,
            'test_mode' => '0',
            'card_token' => '1234567890123456',
            'token_expiry_date' => '1026',
            'card_tail' => '1111',
            'card_brand' => 'Visa',
            'tokenPaymentData_tokenValue' => '1234567890123456',
            'tokenPaymentData_initialTransactionId	' => $tr_id,
            'tokenPaymentData_cardExpiryDate' => '12/28',
            'tokenPaymentData_cardBrand' => 'Visa',
            'tokenPaymentData_cardTail' => '1111',
        ];
        $payload = http_build_query($data);
        $result[] = ['application/x-www-form-urlencoded', $data, $payload, $this->sign($payload, true), self::CORRECT_CODE, true, BasicPayment::class, 'tokenPaymentData_tokenValue', '1234567890123456'];

        $payload = <<<'JSON'
{
  "id": "1010",
  "event": "ALIAS_REGISTER",
  "msg_value": [
    {
      "value": "user_unique_alias_123",
      "type": "UID",
      "expirationDate": "2024-12-10 09:27:59"
    }
  ]
}
JSON;
        $data = json_decode($payload, true);
        $result[] = ['application/json', $data, $payload, $this->sign($payload, true), 'x', true, BlikAliasRegister::class, 'msg_value', ['value' => 'user_unique_alias_123', 'type' => 'UID', 'expirationDate' => '2024-12-10 09:27:59'], BlikAliasRegisterItem::class];

        $payload = http_build_query($data);
        $result[] = ['application/x-www-form-urlencoded', $data, $payload, $this->sign($payload, true), 'x', true, BlikAliasRegister::class, 'msg_value', ['value' => 'user_unique_alias_123', 'type' => 'UID', 'expirationDate' => '2024-12-10 09:27:59'], BlikAliasRegisterItem::class];

        $payload = <<<'JSON'
{
  "id": "1010",
  "event": "ALIAS_UNREGISTER",
  "msg_value": [
    {
      "value": "user_unique_alias_456",
      "type": "UID"
    }
  ]
}
JSON;
        $data = json_decode($payload, true);
        $result[] = ['application/json', $data, $payload, $this->sign($payload, true), 'x', true, BlikAliasUnregister::class, 'msg_value', ['value' => 'user_unique_alias_456', 'type' => 'UID'], BlikAliasUnregisterItem::class];

        $payload = http_build_query($data);
        $result[] = ['application/x-www-form-urlencoded', $data, $payload, $this->sign($payload, true), 'x', true, BlikAliasUnregister::class, 'msg_value', ['value' => 'user_unique_alias_456', 'type' => 'UID',], BlikAliasUnregisterItem::class];

        return $result;
    }

    public function negativeValidationProvider()
    {
        $result = [];

        // gibberish input
        $result[] = ['wrong', [], 'something', 'x', '1234567890', true];

        // missing signature
        $payload = <<<'JSON'
{
  "type": "tokenization",
  "data": {
    "tokenizationId": "TO-1234-890123456789012345678901234567890123456789012345678901234",
    "token": "1234567890123456789012345678901234567890123456789012345678901234",
    "cardBrand": "Mastercard",
    "cardTail": "1111",
    "tokenExpiryDate": "0625"
  }
}
JSON;
        $data = json_decode($payload, true);
        $result[] = ['application/json', $data, $payload, 'x', 'x', true, Tokenization::class, 'tokenizationId', 'TO-1234-890123456789012345678901234567890123456789012345678901234'];

        $result[] = ['application/x-www-form-urlencoded', $data, $payload, 'x', 'x', true, Tokenization::class, 'tokenizationId', 'TO-1234-890123456789012345678901234567890123456789012345678901234'];

        // invalid signature (malformed token)
        $result[] = ['application/json', $data, $payload, 'fdsafsdfafdasfadsf', 'x', true, Tokenization::class, 'tokenizationId', 'TO-1234-890123456789012345678901234567890123456789012345678901234'];

        $result[] = ['application/x-www-form-urlencoded', $data, $payload, 'fdsafsdfafdasfadsf', 'x', true, Tokenization::class, 'tokenizationId', 'TO-1234-890123456789012345678901234567890123456789012345678901234'];

        // invalid signature (payload difference)
        $result[] = ['application/json', $data, $payload, $this->sign($payload.'4324324324234', true), 'x', true, Tokenization::class, 'tokenizationId', 'TO-1234-890123456789012345678901234567890123456789012345678901234'];

        $result[] = ['application/x-www-form-urlencoded', $data, $payload, $this->sign($payload.'4324324324234', true), 'x', true, Tokenization::class, 'tokenizationId', 'TO-1234-890123456789012345678901234567890123456789012345678901234'];

        // invalid signature (invalid algorithm)
        $result[] = ['application/json', $data, $payload, $this->encode(json_encode(['alg' => 'none'])).'..fadsfdasfdsf', 'x', true, Tokenization::class, 'tokenizationId', 'TO-1234-890123456789012345678901234567890123456789012345678901234'];

        $result[] = ['application/x-www-form-urlencoded', $data, $payload, $this->encode(json_encode(['alg' => 'none'])).'..fadsfdasfdsf', 'x', true, Tokenization::class, 'tokenizationId', 'TO-1234-890123456789012345678901234567890123456789012345678901234'];

        // invalid signature (not trusted signature URL)
        $result[] = ['application/json', $data, $payload, $this->encode(json_encode(['alg' => 'RS256', 'x5u' => 'https://example.com/hostile.pem'])).'..fadsfdasfdsf', 'x', true, Tokenization::class, 'tokenizationId', 'TO-1234-890123456789012345678901234567890123456789012345678901234'];

        $result[] = ['application/x-www-form-urlencoded', $data, $payload, $this->encode(json_encode(['alg' => 'RS256', 'x5u' => 'https://example.com/hostile.pem'])).'..fadsfdasfdsf', 'x', true, Tokenization::class, 'tokenizationId', 'TO-1234-890123456789012345678901234567890123456789012345678901234'];

        // invalid signature (prod certificate in sandbox environment)
        $result[] = ['application/json', $data, $payload, $this->sign($payload, true), 'x', false, Tokenization::class, 'tokenizationId', 'TO-1234-890123456789012345678901234567890123456789012345678901234'];

        $result[] = ['application/x-www-form-urlencoded', $data, $payload, $this->sign($payload, true), 'x', false, Tokenization::class, 'tokenizationId', 'TO-1234-890123456789012345678901234567890123456789012345678901234'];

        // invalid md5sum
        $id = '12345';
        $tr_id = 'TR-1234-89012345678901234567890';
        $tr_amount = '144.69';
        $tr_crc = uniqid();
        $md5sum = md5($id.$tr_id.$tr_amount.$tr_crc.self::INVALID_CODE);

        $data = [
            'id' => $id,
            'tr_id' => $tr_id,
            'tr_date' => '2024-12-10 09:27:59',
            'tr_crc' => $tr_crc,
            'tr_amount' => $tr_amount,
            'tr_paid' => $tr_amount,
            'tr_desc' => 'Order #123456',
            'tr_status' => 'PAID',
            'tr_error' => 'none',
            'tr_email' => 'test@example.com',
            'md5sum' => $md5sum,
            'test_mode' => 0,
            'card_token' => '123456789012345678901234567890',
            'token_expiry_date' => '1226',
            'card_tail' => '1111',
            'card_brand' => 'Visa',
        ];
        $payload = http_build_query($data);
        $result[] = ['application/x-www-form-urlencoded', $data, $payload, $this->sign($payload, true), self::CORRECT_CODE, true, BasicPayment::class, 'tr_id', $tr_id];

        return $result;
    }

    private function getCertificateMock()
    {
        if (null === self::$x509) {
            $privateKey = $this->getPrivateKey();

            $csr = openssl_csr_new([], $privateKey);
            $cert = openssl_csr_sign($csr, null, $privateKey, 365);

            openssl_x509_export($cert, $publicKey);

            self::$x509 = new CertificateProviderMock($publicKey);
        }

        return self::$x509;
    }

    private function getPrivateKey()
    {
        if (null === self::$privateKey) {
            self::$privateKey = openssl_pkey_new([
                'private_key_bits' => 2048,
                'private_key_type' => OPENSSL_KEYTYPE_RSA,
            ]);
        }

        return self::$privateKey;
    }

    private function sign($payload, $production = false)
    {
        $signature = '';
        $privateKey = $this->getPrivateKey();

        $headers = [
            'alg' => 'RS256',
            'x5u' => $production ? 'https://secure.tpay.com/faux.pem' : 'https://secure.sandbox.tpay.com/faux.pem',
        ];
        $data = $this->encode(json_encode($headers)).'.'.$this->encode($payload);
        $key = openssl_pkey_get_private($privateKey, null);
        openssl_sign($data, $signature, $key, OPENSSL_ALGO_SHA256);

        return $this->encode(json_encode($headers)).'..'.$this->encode($signature);
    }

    private function encode($payload)
    {
        $result = base64_encode($payload);
        $result = strtr($result, '+/', '-_');

        return rtrim($result, '=');
    }
}
