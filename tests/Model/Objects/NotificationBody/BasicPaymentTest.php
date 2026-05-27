<?php

namespace Tpay\Tests\OpenApi\Model\Objects\NotificationBody;

use PHPUnit\Framework\TestCase;
use Tpay\OpenApi\Model\Objects\NotificationBody\BasicPayment;

class BasicPaymentTest extends TestCase
{
    /**
     * @dataProvider validTestNotificationProvider
     *
     * @param mixed $transactionId
     */
    public function testIsTestNotificationReturnsTrue($transactionId)
    {
        $payment = new BasicPayment();
        $payment->setObjectValues($payment, [
            'tr_id' => $transactionId,
        ]);

        $this->assertTrue($payment->isTestNotification());
    }

    /**
     * @dataProvider invalidTestNotificationProvider
     *
     * @param mixed $transactionId
     */
    public function testIsTestNotificationReturnsFalse($transactionId)
    {
        $payment = new BasicPayment();
        $payment->setObjectValues($payment, [
            'tr_id' => $transactionId,
        ]);

        $this->assertFalse($payment->isTestNotification());
    }

    public static function validTestNotificationProvider()
    {
        return [
            ['TR-123-TST456X'],
            ['TR-ABC-TST999X'],
            ['TR-123ABC-TST456X'],
        ];
    }

    public static function invalidTestNotificationProvider()
    {
        return [
            'empty first part' => ['TR--TST456X'],
            'empty second part' => ['TR-123-TSTX'],
            'missing final X' => ['TR-123-TST456'],
            'wrong prefix' => ['XX-123-TST456X'],
            'missing TST' => ['TR-123-ABC456X'],
            'extra chars after X' => ['TR-123-TST45X6'],
            'first part contains dash' => ['TR-12-3-TST456X'],
        ];
    }
}
