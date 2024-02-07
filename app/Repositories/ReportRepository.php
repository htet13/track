<?php

namespace App\Repositories;

use App\Models\Report;
use App\Repositories\Interfaces\ReportRepositoryInterface;

class ReportRepository implements ReportRepositoryInterface
{
    public function allWithPaginate($filter, $paginate)
    {
        // Use the query scope to retrieve reports with at least one non-zero value
        $reports = Report::withNonZeroValues()->paginate($paginate);

        return $reports;
    }
}
