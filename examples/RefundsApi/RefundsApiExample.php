<?php

namespace Tpay\Example\RefundsApi;

use Tpay\Example\ExamplesConfig;
use Tpay\OpenApi\Api\TpayApi;

final class RefundsApiExample extends ExamplesConfig
{
    private $TpayApi;

    public function __construct()
    {
        parent::__construct();
        $this->TpayApi = new TpayApi(static::MERCHANT_CLIENT_ID, static::MERCHANT_CLIENT_SECRET, true, 'read');
    }

    public function getRefunds()
    {
        $refunds = $this->TpayApi->refunds()->getRefunds();
        var_dump($refunds);

        return $this;
    }

    public function getRefundById($refundId)
    {
        $refund = $this->TpayApi->refunds()->getRefundById($refundId);
        var_dump($refund);

        return $this;
    }
}
(new RefundsApiExample())->getRefunds();
