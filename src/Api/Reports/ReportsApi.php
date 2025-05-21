<?php

namespace Tpay\OpenApi\Api\Reports;

use Tpay\OpenApi\Api\ApiAction;

class ReportsApi extends ApiAction
{
    const SORT_ASC = 'ASC';
    const SORT_DESC = 'DESC';

    public function getReports($page = 1, $pageSize = 20, $sortDirection = self::SORT_ASC)
    {
        $data = [
            'page' => $page,
            'pageSize' => $pageSize,
            'sortDirection' => $sortDirection,
        ];

        return $this->run(static::GET, '/reports?'.http_build_query($data));
    }

    public function getReportFile($reportId, $fileId)
    {
        return $this->download(static::GET, sprintf('/reports/%s/files/%s', $reportId, $fileId));
    }
}
