<?php

namespace Model\Fields;

use PHPUnit\Framework\TestCase;
use Tpay\OpenApi\Model\Fields\Field;

class FieldTest extends TestCase
{
    /**
     * @dataProvider validValueProvider
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
     */
    public function testSetValueInvalid($property, $propertyValue, $valueToSet, $expectedMessage)
    {
        $field = new Field();

        if ($property) {
            $this->setFieldProperty($field, $property, $propertyValue);
        }
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedMessage);

        $field->setValue($valueToSet);
    }

    public function validValueProvider()
    {
        return [
            [
                'property' => null,
                'propertyValue' => null,
                'value' => 123
            ],
            [
                'property' => 'maxLength',
                'propertyValue' => 10,
                'value' => 'test123'
            ],
            [
                'property' => 'minLength',
                'propertyValue' => 3,
                'value' => 'test123'
            ],
            [
                'property' => 'minimum',
                'propertyValue' => 5,
                'value' => 6
            ],
            [
                'property' => 'maximum',
                'propertyValue' => 12,
                'value' => 10
            ],
            [
                'property' => 'enum',
                'propertyValue' => ['one', 'two'],
                'value' => 'one'
            ],
            [
                'property' => 'type',
                'propertyValue' => 'integer',
                'value' => 10
            ],
            [
                'property' => 'pattern',
                'propertyValue' => '^([0-9]{1,3}\.){3}[0-9]{1,3}$',
                'value' => '127.0.0.1'
            ],
        ];
    }

    public function invalidValueProvider()
    {
        return [
            [
                'property' => 'maxLength',
                'propertyValue' => 10,
                'value' => 'test123test123',
                'expectedMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Field is too long. Max allowed 10'
            ],
            [
                'property' => 'minLength',
                'propertyValue' => 3,
                'value' => 'te',
                'expectedMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Field is too short. Min required 3'
            ],
            [
                'property' => 'minimum',
                'propertyValue' => 5,
                'value' => 3,
                'expectedMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Field is too low. Min required 5'
            ],
            [
                'property' => 'maximum',
                'propertyValue' => 5,
                'value' => 10,
                'expectedMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Field exceeds the limit. Max allowed 5'
            ],
            [
                'property' => 'enum',
                'propertyValue' => ['one', 'two'],
                'value' => 'three',
                'expectedMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Field is invalid. Should be one of Array'
            ],
            [
                'property' => 'type',
                'propertyValue' => 'integer',
                'value' => '',
                'expectedMessage' => 'Value type of field Tpay\OpenApi\Model\Fields\Field is invalid. Should be integer type'
            ],
            [
                'property' => 'pattern',
                'propertyValue' => '^([0-9]{1,3}\.){3}[0-9]{1,3}$',
                'value' => 'te.st.12.3',
                'expectedMessage' => 'Value of field Tpay\OpenApi\Model\Fields\Field is invalid. Should match ^([0-9]{1,3}\.){3}[0-9]{1,3}$ pattern'
            ],
        ];
    }

    protected function setFieldProperty($object, $property, $value)
    {
        $ref = new \ReflectionClass($object);
        $prop = $ref->getProperty($property);
        $prop->setAccessible(true);
        $prop->setValue($object, $value);
    }
}