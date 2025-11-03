<?php

namespace Model\Fields\Payer;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tpay\OpenApi\Model\Fields\Payer\IP;

class IpTest extends TestCase
{
    public function testIpv4()
    {
        $ip = new Ip();
        $ip->setValue('127.0.0.1');

        $this->assertSame('127.0.0.1', $ip->getValue());
    }

    public function testIpv6()
    {
        $ip = new Ip();
        $ip->setValue('2001:db8::1');

        $this->assertSame('2001:db8::1', $ip->getValue());
    }

    public function testEmptyString()
    {
        $ip = new Ip();
        $ip->setValue('');

        $this->assertSame('', $ip->getValue());
    }

    public function testNull()
    {
        $ip = new Ip();
        $ip->setValue(null);

        $this->assertSame(null, $ip->getValue());
    }

    public function testInvalidIp()
    {
        $ip = new Ip();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Validation failed for field Tpay\OpenApi\Model\Fields\Payer\IP: Invalid IP address.');

        $ip->setValue('TEST123');
    }

    public function testWrongType()
    {
        $ip = new Ip();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Value type of field Tpay\OpenApi\Model\Fields\Payer\IP is invalid. Should be string type');
        $this->expectExceptionMessage('Validation failed for field Tpay\OpenApi\Model\Fields\Payer\IP: Invalid IP address.');

        $ip->setValue(123212312321);
    }
}
