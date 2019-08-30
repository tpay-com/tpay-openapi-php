<?php
namespace tpaySDK\Examples\RefundsApi;

use tpaySDK\Api\TpayApi;
use tpaySDK\Examples\ExamplesConfig;

require_once '../ExamplesConfig.php';
require_once '../../Loader.php';

class RefundsApiExample extends ExamplesConfig
{
    private $TpayApi;

    public function __construct()
    {
        parent::__construct();
        $this->TpayApi = new TpayApi(static::MERCHANT_CLIENT_ID, static::MERCHANT_CLIENT_SECRET, true, 'read');
    }

    public function getRefunds()
    {
        $refunds = $this->TpayApi->Refunds->getRefunds();
        var_dump($refunds);

        return $this;
    }

    public function getRefundById($refundId)
    {
        $refund = $this->TpayApi->Refunds->getRefundById($refundId);
        var_dump($refund);

        return $this;
    }

}
(new RefundsApiExample)->getRefunds();
