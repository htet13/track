<?php

namespace App\Repositories;

use App\Models\Report;
use App\Repositories\Interfaces\ReportRepositoryInterface;

class ReportRepository implements ReportRepositoryInterface
{
    public function allWithPaginate($filter, $paginate, $type)
    {
        // Use the query scope to retrieve reports with at least one non-zero value
        $reports = Report::withNonZeroValues()
            ->with('fromcities','tocities')
            ->filter($filter)
            ->whereType($type)
            ->paginate($paginate);

        return $reports;
    }
}
