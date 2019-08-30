<?php
namespace tpaySDK\Api\Refunds;

use tpaySDK\Api\ApiAction;

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
