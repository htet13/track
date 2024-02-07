<?php

namespace App\Repositories;

use App\Models\Report;
use App\Models\Track;
use App\Repositories\Interfaces\ReportRepositoryInterface;

class ReportRepository implements ReportRepositoryInterface
{
    public function allWithPaginate($filter, $paginate)
    {
        $reports = Report::paginate($paginate);

        return $reports;
    }
}
