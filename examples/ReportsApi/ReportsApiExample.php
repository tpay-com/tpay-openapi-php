<?php

namespace Tpay\Example\ReportsApi;

use Tpay\Example\ExamplesConfig;
use Tpay\OpenApi\Api\TpayApi;

final class ReportsApiExample extends ExamplesConfig
{
    private $TpayApi;

    public function __construct()
    {
        parent::__construct();
        $this->TpayApi = new TpayApi(self::MERCHANT_CLIENT_ID, self::MERCHANT_CLIENT_SECRET, false, 'read');
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
