<?php

namespace App\Http\Controllers\Backend;

use App\Exports\ReportExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ReportRepositoryInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;
use App\Filters\ReportFilter;
use App\Models\Report;

class ReportController extends Controller
{
    protected $reportRepository, $cityRepository;

    public function __construct(ReportRepositoryInterface $reportRepository, CityRepositoryInterface $cityRepository){
        $this->reportRepository = $reportRepository;
        $this->cityRepository = $cityRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function index(ReportFilter $filter,Request $request, $type)
    {
        $reports = $this->reportRepository->allWithPaginate($filter,30, $type);
        $cities = $this->cityRepository->all();

        if($request->btn == "Export")
        {
            return Excel::download(new ReportExport($reports),'report-'.now().'.xlsx');
        }

        return view('admin.reports.index', compact('reports','cities', 'type'));
    }

    public function show($type, Report $report)
    {
        return view('admin.reports.show', compact('report','type'));
    }
}