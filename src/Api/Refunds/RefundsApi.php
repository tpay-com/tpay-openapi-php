<?php

namespace Tpay\OpenApi\Api\Refunds;

use Tpay\OpenApi\Api\ApiAction;

class RefundsApi extends ApiAction
{
    public function getRefunds()
    {
        return $this->run(static::GET, '/refunds');
    }

    public function getRefundById($refundId)
    {
        return $this->run(static::GET, sprintf('/refunds/%s', $refundId));
    }
}
