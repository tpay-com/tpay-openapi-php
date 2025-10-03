<?php

namespace Factory;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use stdClass;
use Tpay\OpenApi\Factory\ArrayObjectFactory;
use Tpay\OpenApi\Model\Objects\Accounts\Address as AccountAddress;
use Tpay\OpenApi\Model\Objects\Accounts\Person;
use Tpay\OpenApi\Model\Objects\Accounts\PointOfSale as AccountPointOfSale;
use Tpay\OpenApi\Model\Objects\Merchant\Address as MerchantAddress;
use Tpay\OpenApi\Model\Objects\Merchant\ContactPerson;
use Tpay\OpenApi\Model\Objects\Merchant\PointOfSale as MerchantPointOfSale;
use Tpay\OpenApi\Model\Objects\RequestBody\Account;
use Tpay\OpenApi\Model\Objects\RequestBody\Merchant;
use Tpay\OpenApi\Model\Objects\RequestBody\Refund;

class ArrayObjectFactoryTest extends TestCase
{
    /** @dataProvider validObjectProvider */
    public function testValidCreate($fieldName, $object, $expectedResult)
    {
        $factory = new ArrayObjectFactory();
        $result = $factory->create($fieldName, $object);

        $this->assertInstanceOf($expectedResult, $result);
    }

    /** @dataProvider invalidObjectProvider */
    public function testInvalidCreate($fieldName, $object, $exception, $exceptionMessage)
    {
        $factory = new ArrayObjectFactory();

        $this->expectException($exception);
        $this->expectExceptionMessage($exceptionMessage);

        $factory->create($fieldName, $object);
    }

    public function validObjectProvider()
    {
        yield 'merchant Address' => [
            'fieldName' => 'address',
            'object' => new Merchant(),
            'expectedResult' => MerchantAddress::class,
        ];

        yield 'merchant POS' => [
            'fieldName' => 'website',
            'object' => new Merchant(),
            'expectedResult' => MerchantPointOfSale::class,
        ];

        yield 'merchant contactPerson' => [
            'fieldName' => 'contactPerson',
            'object' => new Merchant(),
            'expectedResult' => ContactPerson::class,
        ];

        yield 'account Address' => [
            'fieldName' => 'address',
            'object' => new Account(),
            'expectedResult' => AccountAddress::class,
        ];

        yield 'account POS' => [
            'fieldName' => 'website',
            'object' => new Account(),
            'expectedResult' => AccountPointOfSale::class,
        ];

        yield 'account contactPerson' => [
            'fieldName' => 'person',
            'object' => new Account(),
            'expectedResult' => Person::class,
        ];
    }

    public function invalidObjectProvider()
    {
        yield 'merchant non array field' => [
            'fieldName' => 'email',
            'object' => new Merchant(),
            'exception' => InvalidArgumentException::class,
            'exceptionMessage' => 'Field email as array is not supported in Merchant object',
        ];

        yield 'account non array field' => [
            'fieldName' => 'taxId',
            'object' => new Account(),
            'exception' => InvalidArgumentException::class,
            'exceptionMessage' => 'Field taxId as array is not supported in Account object',
        ];

        yield 'unsupported object' => [
            'fieldName' => 'amount',
            'object' => new Refund(),
            'exception' => InvalidArgumentException::class,
            'exceptionMessage' => 'Field amount as array is not supported in Refund object',
        ];

        yield 'invalid object type' => [
            'fieldName' => 'amount',
            'object' => new StdClass(),
            'exception' => InvalidArgumentException::class,
            'exceptionMessage' => 'Parent object must extend Tpay\OpenApi\Model\Objects\Objects, got stdClass',
        ];
    }
}
