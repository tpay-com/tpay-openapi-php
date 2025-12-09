<?php

namespace Model\Fields\PointOfSale;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tpay\OpenApi\Model\Fields\PointOfSale\Url;

class UrlTest extends TestCase
{
    public function testHTTP()
    {
        $url = new Url();
        $url->setValue('http://example.com');

        $this->assertSame('http://example.com', $url->getValue());
    }

    public function testHTTPS()
    {
        $url = new Url();
        $url->setValue('https://example.com');

        $this->assertSame('https://example.com', $url->getValue());
    }

    public function testCustomScheme()
    {
        $url = new Url();
        $url->setValue('scheme://example.com');

        $this->assertSame('scheme://example.com', $url->getValue());
    }

    public function testLocalhost()
    {
        $url = new Url();
        $url->setValue('https://localhost');

        $this->assertSame('https://localhost', $url->getValue());
    }

    public function testIP()
    {
        $url = new Url();
        $url->setValue('http://127.0.0.1');

        $this->assertSame('http://127.0.0.1', $url->getValue());
    }

    public function testNoScheme()
    {
        $url = new Url();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Validation failed for field Tpay\OpenApi\Model\Fields\PointOfSale\Url: Invalid URL.');

        $url->setValue('www.example.com');
    }

    public function testInvalidType()
    {
        $url = new Url();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Value type of field Tpay\OpenApi\Model\Fields\PointOfSale\Url is invalid. Should be string type');
        $this->expectExceptionMessage('Validation failed for field Tpay\OpenApi\Model\Fields\PointOfSale\Url: Invalid URL.');

        $url->setValue(1234);
    }

    public function testInvalidURL()
    {
        $url = new Url();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Validation failed for field Tpay\OpenApi\Model\Fields\PointOfSale\Url: Invalid URL.');

        $url->setValue('https://');
    }

    public function testToLongURL()
    {
        $url = new Url();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(' Value of field Tpay\OpenApi\Model\Fields\PointOfSale\Url is too long. Max allowed 3072');

        $url->setValue('https://example.com?452f842cf306962bf7d7ed53a0b385550719490dccc16ac766c2a735a7ceaa9f04f5a298f2040760557e5edac1066c27c8de4496221b5974a56cb2645c4249bd3b5174e06d00bc65790fbc190fdea61cc8281b185d34080ab63b128f6aa18cd5afa28d56596e5b9ae32d0e4045c3aa579850c9a70dc983e796eb28899808b65b6f3da68aa83dbd21625cb3ff0430c3f1877f0066650c619d1b5facdcf19a1f17b4b80a828945bde22c80867a8d4ee56d6c1cbfef743fcf8faaf7b4c11724cf5464581b4ae0d3359d256a072d0ccd2a26fb23e8b6d5d731b329e6b99077bba71c6b72e88140f5308512cb5d74e49237f733f8ecb50c384b530e9267bab8bd0b8f68525c11c2edb70b0892f1e51079333fa7f6eaabe24007480b630aa7342ba0c53ffdb8793f9f49f190416ac51db81df93ddd52474f99ea1d3b5e0dd2b6a2329161068d3721fd96a176e0836a0e2fc3177b763843716bf2cfc20af0ac1e868d45e990f490a4e2f5eb6f8a24643d5bc5b1bad78689efbe02ba7b72f1c0b3553076f7e69c5cf4673aef36cc7fbef41706064a50bbdbc3562aff1c765c4a9aa6b8777342b9d98cf9f98a5ea28a144ce118a6f8390fbe39d51fc1ab83b0e0ab4131492a20ae501a48130cdcf069d6c07ca59398baf10b4ea0e7b1d17570c34b8bb9226db7a6a8766b362a9374100da17a0e0135a822497b53564b2a701639f76f9389500ebb7e616a358365e69139427e2b0ca5901b797eb606525af8d5d2dd525c9f5011116b88e27c1d250119c754913dddcb46f48f1e93f643362be190abb6dbf4749afea01404d707189d4fb192869a2778c4cad0f3c929d6033575873ab2b9686408feb750cb24417f13af754f7f4d085efea057689416ca5fe33749b4c2afbce61ce03b40a31232cddc8f6ff1c0406706eeec43fe8679b08ca38a2e9ece00f0f019f303191d0f1e05b67d957bc4b3297888cd5f8e4139b6bfaea61bb98fe594ad2df17f10663dd0ad3a7468d98c999ff5e1f59d6c93240acff16a198abbef353b2f3bb6fe6444b102e1e6f1fce101f3cad50df5be404ce5cf0b227d620b314e2ba342d2fd8f23ef0a690dfec5e32046095ee5081764880684e90f893994f4d407999684e8d0b852940bab295423ed3918afb67bda2bad72e49b5707d4d8f8fd0c4813369d81a856dd66a6cfe03f4924f40cab910ea48a21d800d4408252816f4926eefc12a5910aebd730d6d560154a9e2d80637c7cccbf9912c2d0d6e2dfcbd7566ae9047bd7e67e565d7712cef6e2913d182e3e61f78db38e79350b1c40ed7dbbffd506155f7834621556242348cec84b8393f57b8c0b55d7d54b5b25a70d685a74f6ca9edf46af1d1638a108d543fa17b3048bfded3ab284ff6f1bb92f47cc33bcdc52022491217c2e2ae141f52138728c84a8025075217687f51f7a781d1d0274fbc997c6d2cb6e347ff384c51c194f85b55415f73c890cc68c6cdbced815eea2057994c12d44b179873e036961697ab5266e25edd423365672205f6b13cadb91c309456d3b0bb0795fd4d5714575e8e937ad6f17543598cdf626ac9b567f954e4194d6b24b6ca43790f4057c6bb03a6e0a099046cdd27148dc52ed59745b5b1b4784af42c721837e35d7556fbf3e43275d07ba526aa9653fe353b2570b6cc07d624eeecfa42fddf8a4556bc5378d624d849aa438daf7f77d94185bcbf935d88dd46042ee46302ffca058553590eb1cf8057bad0f1acb5e9df7e3b2e6f5b99511e0d9f260a2cc3aa988179d454989ec752178120262cda928054880cd4488cd961000d305dfadf119e906926a30a40ae3692e8c5119c912a6dffb1ef80eca96bcbdaccfa3c244e057a763d5626ee2b3a9b45dd837ed15ca1373aeb970223bf0003952eafa40c0487f9551d3785ad9eac99b8bf74028095ab320e648f1a4a099494d6c6fa65315737f427f06a8ed2abedb56232fab723cb9d41d14c4ef6fcadbfb2cff6e94d41252ee14888d8cd4ef97cac07da3f9d5f4545dc37bccedd5d8f3a59bf7e1f0f4d932492fef071acad1bbd8e445a2b078e87e2e667135d87b76359aa278036c71e3cf36a4148db64852a069723d382246a03d41d960817ac7d5eee6422479180874981c6223e38333f0002c6e467ba3');
    }
}