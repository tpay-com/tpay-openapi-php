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

        CurlMock::setConsecutiveReturnedTransfers('"ok"');

        $result = $transactionsApi->createTransaction($transactionData);

        self::assertSame('ok', $result);
    }

    public function testInitApplePay()
    {
        $accessToken = $this->createMock(AccessToken::class);

        $token = $this->createMock(Token::class);
        $token->access_token = $accessToken;

        $transactionsApi = new TransactionsApi($token, false);

        CurlMock::setConsecutiveReturnedTransfers('"ok"');

        $result = $transactionsApi->initApplePay([
            'domainName' => 'secure.tpay.com',
            'displayName' => 'https://openapi.tpay.com/#/wallet',
            'validationUrl' => 'https://apple-pay-gateway-cert.apple.com/paymentservices/startSession',
        ]);

        self::assertSame('ok', $result);
    }

    public function testCancelTransaction()
    {
        $accessToken = $this->createMock(AccessToken::class);

        $token = $this->createMock(Token::class);
        $token->access_token = $accessToken;

        $transactionsApi = new TransactionsApi($token, false);

        CurlMock::setConsecutiveReturnedTransfers('"ok"');

        $result = $transactionsApi->cancelTransaction('ta_ABC');

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

        $transactionData['pay'] = [
            'groupId' => 150,
            'method' => 'pay_by_link',
        ];

        yield 'with pay' => [$transactionData];

        $transactionData['pay'] = [
            'groupId' => 150,
            'method' => 'pay_by_link',
            'blikPaymentData' => [
                'blikToken' => '777111',
                'aliases' => [
                    'value' => 'tpay1',
                    'type' => 'PAYID',
                    'label' => 'test label',
                    'key' => '1',
                    'autopayment' => [
                        'model' => 'A',
                        'frequency' => '17D',
                        'singleLimitAmount' => 0,
                        'totalLimitAmount' => 1,
                        'currency' => 'PLN',
                        'initDate' => '2025-05-21T14:39:27.388Z',
                        'expirationDate' => '2025-05-21T14:39:27.388Z',
                    ],
                ],
            ],
        ];

        yield 'with pay (blik)' => [$transactionData];

        $transactionData['pay'] = [
            'groupId' => 150,
            'method' => 'pay_by_link',
            'cardPaymentData' => [
                'card' => 'VEJUfiiBqj8huhZfi84UWBHFwyVJCeanbF6zJDtWwoW9ugQB+x7MzESIgic1Bw7YBW1Yc1i49UeR+IhmXsFQiWh6aS35KyG1q\n2RrVN+NWYJDQEvvDpISyYdCghFjjLCXL2Fkp5KeLfUTWkKOMeisr/b3/Gbup37XA7DTYX8gn4Es/KO0PdiI/brO+S5+YrX4/UcQOT+eosL7r7rSSJfe8KaT\n8GywyoaWl8S41Cw1B41ddkGKvDOSIbbatALi3TdjJrHe7SkVmYSZNbkb9ri1RBw9ceX2QVGeO4CKKido29ySgWm64Gqfk4pgGBFqqUc8/ThwCI3n+FCmtWx\nntCovtw==',
                'save' => true,
                'rocText' => 'RocText1',
            ],
            'cof' => 'unscheduled',
        ];

        yield 'with pay (cardPaymentData.card)' => [$transactionData];

        $transactionData['pay'] = [
            'groupId' => 150,
            'method' => 'pay_by_link',
            'cardPaymentData' => [
                'token' => 't59c2810d59285e3e0ee9d1f1eda1c2f4c554e24',
                'rocText' => 'TEST123',
            ],
        ];

        yield 'with pay (cardPaymentData.token)' => [$transactionData];

        $transactionData['pay'] = [
            'groupId' => 150,
            'method' => 'pay_by_link',
            'tokenPaymentData' => [
                'tokenValue' => 't59c2810d59285e3e0e',
                'cardExpiryDate' => '2808',
                'initialTransactionId' => '123',
                'cardBrand' => 'VI',
                'rocText' => 'abc123',
            ],
        ];

        yield 'with pay (tokenPaymentData)' => [$transactionData];

        $transactionData['pay'] = [
            'groupId' => 150,
            'method' => 'pay_by_link',
            'applePayPaymentData' => 'ewogICJkYXRhIjogInh4eHgiLAogICJzaWduYXR1cmUiOiAieHh4eCIsCiAgImhlYWRlciI6IHsKICAgICJwdWJsaWNLZXlIY\nXNoIjogInh4eHgiLAogICAgImVwaGVtZXJhbFB1YmxpY0tleSI6ICJ4eHh4IiwKICAgICJ0cmFuc2FjdGlvbklkIjogInh4eHgiCiAgfSwKICAidmVyc2lv\nbiI6ICJFQ192MSIKfQo',
        ];

        yield 'with pay (applePay)' => [$transactionData];

        unset($transactionData['pay']);

        $transactionData['collect'] = [
            'account' => 'CHANGE_THIS_TO_VALID_ACCOUNT_NUMBER',
            'receiver' => 'CHANGE_THIS_TO_VALID_RECEIVER_NAME',
        ];

        yield 'with collect' => [$transactionData];
    }
}
