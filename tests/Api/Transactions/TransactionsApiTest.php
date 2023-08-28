<?php

namespace Tpay\Tests\OpenApi\Api\Transactions;

use PHPUnit\Framework\TestCase;
use Tpay\OpenApi\Api\Transactions\TransactionsApi;
use Tpay\OpenApi\Model\Fields\Token\AccessToken;
use Tpay\OpenApi\Model\Objects\Authorization\Token;
use Tpay\Tests\OpenApi\Mock\CurlMock;

/**
 * @covers \Tpay\OpenApi\Api\Transactions\TransactionsApi
 */
class TransactionsApiTest extends TestCase
{
    /** @dataProvider dataCreatingTransaction */
    public function testCreatingTransaction(array $transactionData)
    {
        $accessToken = $this->createMock(AccessToken::class);

        $token = $this->createMock(Token::class);
        $token->access_token = $accessToken;

        $transactionsApi = new TransactionsApi($token, false);

        CurlMock::createMock('"ok"');

        $result = $transactionsApi->createTransaction($transactionData);

        self::assertSame('ok', $result);
    }

    public static function dataCreatingTransaction()
    {
        $transactionData = [
            'amount' => 0.10,
            'description' => 'test transaction',
            'hiddenDescription' => 'order_213',
            'payer' => [
                'email' => 'john.doe@example.com',
                'name' => 'John Doe',
                'phone' => '123456789',
                'address' => 'Long Street 123/2',
                'code' => '11-123',
                'city' => 'New York',
                'country' => 'US',
            ],
            'lang' => 'en',
            'callbacks' => [
                'notification' => [
                    'url' => 'https://example.com/notification',
                    'email' => 'merchant@example.com',
                ],
                'payerUrls' => [
                    'success' => 'https://example.com/success',
                    'error' => 'https://example.com/error',
                ],
            ],
        ];

        yield 'without payer.taxId' => [$transactionData];

        $transactionData['payer']['taxId'] = 'PL3774716081';

        yield 'with payer.taxId' => [$transactionData];
    }
}
