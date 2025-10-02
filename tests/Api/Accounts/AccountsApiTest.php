<?php

namespace Api\Accounts;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tpay\OpenApi\Api\Accounts\AccountsApi;
use Tpay\OpenApi\Model\Fields\Token\AccessToken;
use Tpay\OpenApi\Model\Objects\Authorization\Token;
use Tpay\Tests\OpenApi\Mock\CurlMock;
use UnexpectedValueException;

class AccountsApiTest extends TestCase
{
    /** @dataProvider validMerchantData */
    public function testCreatingValidMerchant(array $merchantData)
    {
        $transactionsApi = $this->createAccountsApiWithCurlMock('ok');

        $result = $transactionsApi->createMerchant($merchantData);

        self::assertSame('ok', $result);
    }

    /** @dataProvider invalidMerchantData */
    public function testCreatingInvalidMerchant(array $merchantData, $exception, $exceptionMessage)
    {
        $transactionsApi = $this->createAccountsApiWithCurlMock('error');

        $this->expectException($exception);
        $this->expectExceptionMessage($exceptionMessage);
        $transactionsApi->createMerchant($merchantData);
    }

    private function createAccountsApiWithCurlMock($response)
    {
        $accessToken = $this->createMock(AccessToken::class);

        $token = $this->createMock(Token::class);
        $token->access_token = $accessToken;

        $transactionsApi = new AccountsApi($token, false);

        CurlMock::setConsecutiveReturnedTransfers(json_encode($response));

        return $transactionsApi;
    }

    public function validMerchantData()
    {
        yield 'One Address' => [
            [
                'offerCode' => 'XXXXX',
                'email' => 'admin@exmaple.com',
                'taxId' => '1234567890',
                'legalForm' => 1,
                'categoryId' => 2,
                'address' => [
                    [
                        'name' => 'Example Sp.z.o.o',
                        'street' => 'ulica',
                        'houseNumber' => '123',
                        'postalCode' => '11-111',
                        'city' => 'Poznań',
                        'country' => 'PL',
                        'isMain' => true,
                        'isInvoice' => true,
                        'isCorrespondence' => true,
                    ],
                ],
                'website' => [
                    [
                        'name' => 'www.example.com',
                        'url' => 'https://www.example.com',
                    ]
                ]
            ]
        ];

        yield 'Different Addresses' => [
            [
                'offerCode' => 'XXXXX',
                'email' => 'admin@exmaple.com',
                'taxId' => '1234567890',
                'legalForm' => 1,
                'categoryId' => 2,
                'address' => [
                    [
                        'name' => 'Example Sp.z.o.o',
                        'street' => 'ulica1',
                        'houseNumber' => '123',
                        'postalCode' => '11-111',
                        'city' => 'Poznań',
                        'country' => 'PL',
                        'isMain' => true,
                    ],
                    [
                        'name' => 'Example Sp.z.o.o',
                        'street' => 'ulica2',
                        'houseNumber' => '456',
                        'postalCode' => '11-111',
                        'city' => 'Poznań',
                        'country' => 'PL',
                        'isMain' => false,
                        'isInvoice' => true,
                    ],
                    [
                        'name' => 'Example Sp.z.o.o',
                        'street' => 'ulica3',
                        'houseNumber' => '789',
                        'postalCode' => '11-111',
                        'city' => 'Poznań',
                        'country' => 'PL',
                        'isMain' => false,
                        'isCorrespondence' => true,
                    ],
                ],
                'website' => [
                    [
                        'name' => 'www.example.com',
                        'url' => 'https://www.example.com',
                    ]
                ]
            ]
        ];

        yield 'Many websites' => [
            [
                'offerCode' => 'XXXXX',
                'email' => 'admin@exmaple.com',
                'taxId' => '1234567890',
                'legalForm' => 1,
                'categoryId' => 2,
                'address' => [
                    [
                        'name' => 'Example Sp.z.o.o',
                        'street' => 'ulica1',
                        'houseNumber' => '123',
                        'postalCode' => '11-111',
                        'city' => 'Poznań',
                        'country' => 'PL',
                        'isMain' => true,
                    ],
                ],
                'website' => [
                    [
                        'name' => 'www.example1.com',
                        'url' => 'https://www.example1.com',
                    ],
                    [
                        'name' => 'www.example2.com',
                        'url' => 'https://www.example2.com',
                    ],
                    [
                        'name' => 'www.example3.com',
                        'url' => 'https://www.example3.com',
                    ]
                ]
            ]
        ];
    }

    public function invalidMerchantData()
    {
        yield 'No Offer Code' => [
            [
                'email' => 'admin@exmaple.com',
                'taxId' => '1234567890',
                'legalForm' => 1,
                'categoryId' => 2,
                'address' => [
                    [
                        'name' => 'Example Sp.z.o.o',
                        'street' => 'ulica',
                        'houseNumber' => '123',
                        'postalCode' => '11-111',
                        'city' => 'Poznań',
                        'country' => 'PL',
                        'isMain' => true,
                        'isInvoice' => true,
                        'isCorrespondence' => true,
                    ],
                ],
                'website' => [
                    [
                        'name' => 'www.example.com',
                        'url' => 'https://www.example.com',
                    ]
                ]
            ],
            'exception' => UnexpectedValueException::class,
            'exceptionMessage' => 'Field "Tpay\OpenApi\Model\Fields\Account\OfferCode" is required in object Merchant'
        ];

        yield 'No email address' => [
            [
                'offerCode' => 'XXXXX',
                'taxId' => '1234567890',
                'legalForm' => 1,
                'categoryId' => 2,
                'address' => [
                    [
                        'name' => 'Example Sp.z.o.o',
                        'street' => 'ulica1',
                        'houseNumber' => '123',
                        'postalCode' => '11-111',
                        'city' => 'Poznań',
                        'country' => 'PL',
                        'isMain' => true,
                    ],
                ],
                'website' => [
                    [
                        'name' => 'www.example.com',
                        'url' => 'https://www.example.com',
                    ],
                ]
            ],
            'exception' => UnexpectedValueException::class,
            'exceptionMessage' => 'Field "Tpay\OpenApi\Model\Fields\Person\Email" is required in object Merchant'
        ];

        yield 'No legalForm' => [
            [
                'offerCode' => 'XXXXX',
                'email' => 'admin@example.com',
                'taxId' => '1234567890',
                'categoryId' => 2,
                'address' => [
                    [
                        'name' => 'Example Sp.z.o.o',
                        'street' => 'ulica1',
                        'houseNumber' => '123',
                        'postalCode' => '11-111',
                        'city' => 'Poznań',
                        'country' => 'PL',
                        'isMain' => true,
                    ],
                ],
                'website' => [
                    [
                        'name' => 'www.example.com',
                        'url' => 'https://www.example.com',
                    ],
                ]
            ],
            'exception' => UnexpectedValueException::class,
            'exceptionMessage' => 'Field "Tpay\OpenApi\Model\Fields\Account\LegalForm" is required in object Merchant'
        ];

        yield 'No categoryId' => [
            [
                'offerCode' => 'XXXXX',
                'email' => 'admin@example.com',
                'taxId' => '1234567890',
                'legalForm' => 1,
                'address' => [
                    [
                        'name' => 'Example Sp.z.o.o',
                        'street' => 'ulica1',
                        'houseNumber' => '123',
                        'postalCode' => '11-111',
                        'city' => 'Poznań',
                        'country' => 'PL',
                        'isMain' => true,
                    ],
                ],
                'website' => [
                    [
                        'name' => 'www.example.com',
                        'url' => 'https://www.example.com',
                    ],
                ]
            ],
            'exception' => UnexpectedValueException::class,
            'exceptionMessage' => 'Field "Tpay\OpenApi\Model\Identifiers\CategoryId" is required in object Merchant'
        ];

        yield 'Empty address' => [
            [
                'offerCode' => 'XXXXX',
                'email' => 'admin@example.com',
                'taxId' => '1234567890',
                'legalForm' => 1,
                'categoryId' => 0,
                'address' => [
                ],
                'website' => [
                    [
                        'name' => 'www.example.com',
                        'url' => 'https://www.example.com',
                    ],
                ]
            ],
            'exception' => UnexpectedValueException::class,
            'exceptionMessage' => 'Field "Tpay\OpenApi\Model\Fields\Address\Name" is required in object Address'
        ];

        yield 'No address' => [
            [
                'offerCode' => 'XXXXX',
                'email' => 'admin@example.com',
                'taxId' => '1234567890',
                'legalForm' => 1,
                'categoryId' => 0,
                'website' => [
                    [
                        'name' => 'www.example.com',
                        'url' => 'https://www.example.com',
                    ],
                ]
            ],
            'exception' => UnexpectedValueException::class,
            'exceptionMessage' => 'Field "Tpay\OpenApi\Model\Fields\Address\Name" is required in object Address'
        ];

        yield 'Empty website' => [
            [
                'offerCode' => 'XXXXX',
                'email' => 'admin@example.com',
                'taxId' => '1234567890',
                'legalForm' => 1,
                'categoryId' => 0,
                'address' => [
                    [
                        'name' => 'Example Sp.z.o.o',
                        'street' => 'ulica1',
                        'houseNumber' => '123',
                        'postalCode' => '11-111',
                        'city' => 'Poznań',
                        'country' => 'PL',
                        'isMain' => true,
                    ],
                ],
                'website' => [

                ]
            ],
            'exception' => UnexpectedValueException::class,
            'exceptionMessage' => 'Field "Tpay\OpenApi\Model\Fields\PointOfSale\Name" is required in object PointOfSale'
        ];

        yield 'No website' => [
            [
                'offerCode' => 'XXXXX',
                'email' => 'admin@example.com',
                'taxId' => '1234567890',
                'legalForm' => 1,
                'categoryId' => 0,
                'address' => [
                    [
                        'name' => 'Example Sp.z.o.o',
                        'street' => 'ulica1',
                        'houseNumber' => '123',
                        'postalCode' => '11-111',
                        'city' => 'Poznań',
                        'country' => 'PL',
                        'isMain' => true,
                    ],
                ],
            ],
            'exception' => UnexpectedValueException::class,
            'exceptionMessage' => 'Field "Tpay\OpenApi\Model\Fields\PointOfSale\Name" is required in object PointOfSale'
        ];

        yield 'No street in address' => [
            [
                'offerCode' => 'XXXXX',
                'email' => 'admin@exmaple.com',
                'taxId' => '1234567890',
                'legalForm' => 1,
                'categoryId' => 2,
                'address' => [
                    [
                        'name' => 'Example Sp.z.o.o',
                        'houseNumber' => '123',
                        'postalCode' => '11-111',
                        'city' => 'Poznań',
                        'country' => 'PL',
                        'isMain' => true,
                    ],
                ],
                'website' => [
                    [
                        'name' => 'www.example1.com',
                        'url' => 'https://www.example1.com',
                    ],
                ]
            ],
            'exception' => UnexpectedValueException::class,
            'exceptionMessage' => 'Field "Tpay\OpenApi\Model\Fields\Address\Street" is required in object Address'
        ];

        yield 'No house number in address' => [
            [
                'offerCode' => 'XXXXX',
                'email' => 'admin@exmaple.com',
                'taxId' => '1234567890',
                'legalForm' => 1,
                'categoryId' => 2,
                'address' => [
                    [
                        'name' => 'Example Sp.z.o.o',
                        'street' => 'glowna',
                        'postalCode' => '11-111',
                        'city' => 'Poznań',
                        'country' => 'PL',
                        'isMain' => true,
                    ],
                ],
                'website' => [
                    [
                        'name' => 'www.example1.com',
                        'url' => 'https://www.example1.com',
                    ],
                ]
            ],
            'exception' => UnexpectedValueException::class,
            'exceptionMessage' => 'Field "Tpay\OpenApi\Model\Fields\Address\HouseNumber" is required in object Address'
        ];

        yield 'No postal code in address' => [
            [
                'offerCode' => 'XXXXX',
                'email' => 'admin@exmaple.com',
                'taxId' => '1234567890',
                'legalForm' => 1,
                'categoryId' => 2,
                'address' => [
                    [
                        'name' => 'Example Sp.z.o.o',
                        'street' => 'glowna',
                        'houseNumber' => '123',
                        'city' => 'Poznań',
                        'country' => 'PL',
                        'isMain' => true,
                    ],
                ],
                'website' => [
                    [
                        'name' => 'www.example1.com',
                        'url' => 'https://www.example1.com',
                    ],
                ]
            ],
            'exception' => UnexpectedValueException::class,
            'exceptionMessage' => 'Field "Tpay\OpenApi\Model\Fields\Address\PostalCode" is required in object Address'
        ];

        yield 'No city in address' => [
            [
                'offerCode' => 'XXXXX',
                'email' => 'admin@exmaple.com',
                'taxId' => '1234567890',
                'legalForm' => 1,
                'categoryId' => 2,
                'address' => [
                    [
                        'name' => 'Example Sp.z.o.o',
                        'street' => 'glowna',
                        'houseNumber' => '123',
                        'postalCode' => '11-111',
                        'country' => 'PL',
                        'isMain' => true,
                    ],
                ],
                'website' => [
                    [
                        'name' => 'www.example1.com',
                        'url' => 'https://www.example1.com',
                    ],
                ]
            ],
            'exception' => UnexpectedValueException::class,
            'exceptionMessage' => 'Field "Tpay\OpenApi\Model\Fields\Address\City" is required in object Address'
        ];

        yield 'No country in address' => [
            [
                'offerCode' => 'XXXXX',
                'email' => 'admin@exmaple.com',
                'taxId' => '1234567890',
                'legalForm' => 1,
                'categoryId' => 2,
                'address' => [
                    [
                        'name' => 'Example Sp.z.o.o',
                        'street' => 'glowna',
                        'houseNumber' => '123',
                        'postalCode' => '11-111',
                        'city' => 'Warszawa',
                        'isMain' => true,
                    ],
                ],
                'website' => [
                    [
                        'name' => 'www.example1.com',
                        'url' => 'https://www.example1.com',
                    ],
                ]
            ],
            'exception' => UnexpectedValueException::class,
            'exceptionMessage' => 'Field "Tpay\OpenApi\Model\Fields\Address\Country" is required in object Address'
        ];

        yield 'Too long country in address' => [
            [
                'offerCode' => 'XXXXX',
                'email' => 'admin@exmaple.com',
                'taxId' => '1234567890',
                'legalForm' => 1,
                'categoryId' => 2,
                'address' => [
                    [
                        'name' => 'Example Sp.z.o.o',
                        'street' => 'glowna',
                        'houseNumber' => '123',
                        'postalCode' => '11-111',
                        'city' => 'Warszawa',
                        'country' => 'Polska',
                        'isMain' => true,
                    ],
                ],
                'website' => [
                    [
                        'name' => 'www.example1.com',
                        'url' => 'https://www.example1.com',
                    ],
                ]
            ],
            'exception' => InvalidArgumentException::class,
            'exceptionMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Address\Country is too long. Max allowed 2'
        ];

        yield 'Too short country in address' => [
            [
                'offerCode' => 'XXXXX',
                'email' => 'admin@exmaple.com',
                'taxId' => '1234567890',
                'legalForm' => 1,
                'categoryId' => 2,
                'address' => [
                    [
                        'name' => 'Example Sp.z.o.o',
                        'street' => 'glowna',
                        'houseNumber' => '123',
                        'postalCode' => '11-111',
                        'city' => 'Warszawa',
                        'country' => 'P',
                        'isMain' => true,
                    ],
                ],
                'website' => [
                    [
                        'name' => 'www.example1.com',
                        'url' => 'https://www.example1.com',
                    ],
                ]
            ],
            'exception' => InvalidArgumentException::class,
            'exceptionMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Address\Country is too short. Min required 2'
        ];

        yield 'Multi main addresses' => [
            [
                'offerCode' => 'XXXXX',
                'email' => 'admin@exmaple.com',
                'taxId' => '1234567890',
                'legalForm' => 1,
                'categoryId' => 2,
                'address' => [
                    [
                        'name' => 'Example Sp.z.o.o',
                        'street' => 'glowna',
                        'houseNumber' => '123',
                        'postalCode' => '11-111',
                        'city' => 'Warszawa',
                        'country' => 'PL',
                        'isMain' => true,
                    ],
                    [
                        'name' => 'Example Sp.z.o.o',
                        'street' => 'glowna',
                        'houseNumber' => '123',
                        'postalCode' => '11-111',
                        'city' => 'Warszawa',
                        'country' => 'PL',
                        'isMain' => true,
                    ],
                ],
                'website' => [
                    [
                        'name' => 'www.example1.com',
                        'url' => 'https://www.example1.com',
                    ],
                ]
            ],
            'exception' => UnexpectedValueException::class,
            'exceptionMessage' => 'Field "isMain" with value "true" must be unique across Address objects'
        ];
    }
}