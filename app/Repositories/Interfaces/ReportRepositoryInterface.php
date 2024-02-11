<?php
namespace App\Repositories\Interfaces;

use App\Filters\ReportFilter;

Interface ReportRepositoryInterface{
    public function allWithPaginate(ReportFilter $filter,$paginate, $type);
}
