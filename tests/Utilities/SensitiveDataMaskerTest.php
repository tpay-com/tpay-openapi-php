<?php

namespace Tpay\Tests\OpenApi\Utilities;

use PHPUnit\Framework\TestCase;
use Tpay\OpenApi\Utilities\SensitiveDataMasker;

/**
 * @covers \Tpay\OpenApi\Utilities\SensitiveDataMasker
 */
class SensitiveDataMaskerTest extends TestCase
{
    public function testMasksCredentials()
    {
        $masked = SensitiveDataMasker::maskData([
            'client_id' => '12345-abc',
            'client_secret' => 'super-secret',
            'scope' => 'read',
            'access_token' => 'token-value',
        ]);

        self::assertSame('12345-abc', $masked['client_id']);
        self::assertSame('read', $masked['scope']);
        self::assertSame(SensitiveDataMasker::MASK, $masked['client_secret']);
        self::assertSame(SensitiveDataMasker::MASK, $masked['access_token']);
    }

    public function testMasksPaymentAndPayerDataRecursively()
    {
        $masked = SensitiveDataMasker::maskData([
            'amount' => 10.5,
            'description' => 'Order 1',
            'payer' => ['email' => 'jan@example.com', 'name' => 'Jan Kowalski'],
            'pay' => [
                'groupId' => 150,
                'blikPaymentData' => ['blikToken' => '777123'],
                'cardPaymentData' => ['card' => 'encrypted-card-data'],
            ],
            'transactions' => [['payer' => ['email' => 'a@example.com']]],
        ]);

        self::assertSame(10.5, $masked['amount']);
        self::assertSame('Order 1', $masked['description']);
        self::assertSame(150, $masked['pay']['groupId']);
        self::assertSame(SensitiveDataMasker::MASK, $masked['payer']);
        self::assertSame(SensitiveDataMasker::MASK, $masked['pay']['blikPaymentData']);
        self::assertSame(SensitiveDataMasker::MASK, $masked['pay']['cardPaymentData']);
        self::assertSame(SensitiveDataMasker::MASK, $masked['transactions'][0]['payer']);

        $encoded = json_encode($masked);
        self::assertFalse(strpos($encoded, '777123'));
        self::assertFalse(strpos($encoded, 'jan@example.com'));
        self::assertFalse(strpos($encoded, 'Kowalski'));
    }

    public function testKeepsNonArrayValues()
    {
        self::assertNull(SensitiveDataMasker::maskData(null));
        self::assertSame('text', SensitiveDataMasker::maskData('text'));
    }

    public function testMasksAuthorizationHeader()
    {
        $masked = SensitiveDataMasker::maskHeaders([
            'Authorization: Bearer abc.def-ghi',
            'Content-Type: application/json',
        ]);

        self::assertSame(['Authorization: Bearer ***', 'Content-Type: application/json'], $masked);
    }

    public function testMasksFreeText()
    {
        $text = 'Fields: {"client_secret":"s3cr3t","client_id":"1-a","access_token":"tok"} Headers: ["Authorization: Bearer abc123"] url?client_secret=xyz&x=1';

        $masked = SensitiveDataMasker::maskString($text);

        self::assertFalse(strpos($masked, 's3cr3t'));
        self::assertFalse(strpos($masked, '"tok"'));
        self::assertFalse(strpos($masked, 'abc123'));
        self::assertFalse(strpos($masked, 'xyz'));
        self::assertNotFalse(strpos($masked, '"client_id":"1-a"'));
        self::assertNotFalse(strpos($masked, 'x=1'));
    }
}
