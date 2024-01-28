<?php

namespace App\Repositories;

use App\Models\Track;
use App\Repositories\Interfaces\ReportRepositoryInterface;

class ReportRepository implements ReportRepositoryInterface
{
    public function allWithPaginate($filter,$paginate)
    {
        $reports = Track::filter($filter)
        ->paginate($paginate);
        return $reports;
    }
}
