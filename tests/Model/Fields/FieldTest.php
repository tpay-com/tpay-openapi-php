<?php

namespace Model\Fields;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Tpay\OpenApi\Model\Fields\Field;

class FieldTest extends TestCase
{
    /**
     * @dataProvider validValueProvider
     *
     * @param mixed $property
     * @param mixed $propertyValue
     * @param mixed $valueToSet
     */
    public function testSetValueValid($property, $propertyValue, $valueToSet)
    {
        $field = new Field();

        if ($property) {
            $this->setFieldProperty($field, $property, $propertyValue);
        }
        $field->setValue($valueToSet);
        $this->assertSame($valueToSet, $field->getValue());
    }

    /**
     * @dataProvider invalidValueProvider
     *
     * @param mixed $property
     * @param mixed $propertyValue
     * @param mixed $valueToSet
     * @param mixed $expectedMessage
     */
    public function testSetValueInvalid($property, $propertyValue, $valueToSet, $expectedMessage)
    {
        $field = new Field();

        if ($property) {
            $this->setFieldProperty($field, $property, $propertyValue);
        }
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedMessage);

        $field->setValue($valueToSet);
    }

    public function validValueProvider()
    {
        return [
            'No conditions' => [
                'property' => null,
                'propertyValue' => null,
                'value' => 123,
            ],
            'Max length' => [
                'property' => 'maxLength',
                'propertyValue' => 10,
                'value' => 'test123',
            ],
            'Min length' => [
                'property' => 'minLength',
                'propertyValue' => 3,
                'value' => 'test123',
            ],
            'Min value' => [
                'property' => 'minimum',
                'propertyValue' => 5,
                'value' => 6,
            ],
            'Max value' => [
                'property' => 'maximum',
                'propertyValue' => 12,
                'value' => 10,
            ],
            'Enum value' => [
                'property' => 'enum',
                'propertyValue' => ['one', 'two'],
                'value' => 'one',
            ],
            'Type' => [
                'property' => 'type',
                'propertyValue' => 'integer',
                'value' => 10,
            ],
            'Ipv4' => [
                'property' => 'pattern',
                'propertyValue' => '^([0-9]{1,3}\.){3}[0-9]{1,3}$',
                'value' => '127.0.0.1',
            ],
        ];
    }

    public function invalidValueProvider()
    {
        return [
            'Over max length' => [
                'property' => 'maxLength',
                'propertyValue' => 10,
                'value' => 'test123test123',
                'expectedMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Field is too long. Max allowed 10',
            ],
            'Under min length' => [
                'property' => 'minLength',
                'propertyValue' => 3,
                'value' => 'te',
                'expectedMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Field is too short. Min required 3',
            ],
            'Under minimum value' => [
                'property' => 'minimum',
                'propertyValue' => 5,
                'value' => 3,
                'expectedMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Field is too low. Min required 5',
            ],
            'Over max value' => [
                'property' => 'maximum',
                'propertyValue' => 5,
                'value' => 10,
                'expectedMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Field exceeds the limit. Max allowed 5',
            ],
            'Wrong enum value' => [
                'property' => 'enum',
                'propertyValue' => ['one', 'two'],
                'value' => 'three',
                'expectedMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Field is invalid. Should be one of Array',
            ],
            'Wrong type' => [
                'property' => 'type',
                'propertyValue' => 'integer',
                'value' => '',
                'expectedMessage' => 'Value type of field Tpay\OpenApi\Model\Fields\Field is invalid. Should be integer type',
            ],
            'Ipv6' => [
                'property' => 'pattern',
                'propertyValue' => '^([0-9]{1,3}\.){3}[0-9]{1,3}$',
                'value' => '::1',
                'expectedMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Field is invalid. Should match ^([0-9]{1,3}\.){3}[0-9]{1,3}$ pattern',
            ],
        ];
    }

    protected function setFieldProperty($object, $property, $value)
    {
        $ref = new ReflectionClass($object);
        $prop = $ref->getProperty($property);
        $prop->setAccessible(true);
        $prop->setValue($object, $value);
    }
}
