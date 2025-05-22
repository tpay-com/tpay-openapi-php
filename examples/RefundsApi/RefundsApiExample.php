<?php

namespace Tpay\Example\RefundsApi;

use Doctrine\Common\Cache\FilesystemCache;
use PSX\Cache\SimpleCache;
use Tpay\Example\ExamplesConfig;
use Tpay\OpenApi\Api\TpayApi;
use Tpay\OpenApi\Utilities\Cache;

final class RefundsApiExample extends ExamplesConfig
{
    private $TpayApi;

    public function __construct()
    {
        parent::__construct();
        // You can inject any of your PSR6 or PSR16 cache implementation
        $cache = new Cache(null, new SimpleCache(new FilesystemCache(__DIR__.'/cache/')));
        $this->TpayApi = new TpayApi($cache, self::MERCHANT_CLIENT_ID, self::MERCHANT_CLIENT_SECRET, true, 'read');
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
