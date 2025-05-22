<?php

namespace Tpay\Example\ReportsApi;

use Doctrine\Common\Cache\FilesystemCache;
use PSX\Cache\SimpleCache;
use Tpay\Example\ExamplesConfig;
use Tpay\OpenApi\Api\TpayApi;
use Tpay\OpenApi\Utilities\Cache;

final class ReportsApiExample extends ExamplesConfig
{
    private $TpayApi;

    public function __construct()
    {
        parent::__construct();
        $cache = new Cache(null, new SimpleCache(new FilesystemCache(__DIR__.'/cache/')));
        $this->TpayApi = new TpayApi($cache, self::MERCHANT_CLIENT_ID, self::MERCHANT_CLIENT_SECRET, false, 'read');
    }

    public function getReports()
    {
        $refunds = $this->TpayApi->reports()->getReports();
        var_dump($refunds);

        return $this;
    }

    public function getReportFile($reportId, $fileId)
    {
        $handle = $this->TpayApi->reports()->getReportFile($reportId, $fileId);
        if ($handle) {
            while (($buffer = fgets($handle, 4096)) !== false) {
                echo $buffer;
            }
        }

        return $this;
    }
}

(new ReportsApiExample())->getReports();
