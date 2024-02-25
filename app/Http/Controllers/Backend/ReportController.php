<?php

namespace App\Http\Controllers\Backend;

use App\Exports\ReportExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ReportRepositoryInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\CarNoRepositoryInterface;
use App\Repositories\Interfaces\IssuerRepositoryInterface;
use App\Repositories\Interfaces\DriverRepositoryInterface;
use App\Repositories\Interfaces\SpareRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;
use App\Filters\ReportFilter;
use App\Filters\TrackFilter;
use App\Models\Report;

class ReportController extends Controller
{
    protected $reportRepository, $cityRepository, $carNoRepository, $driverRepository, $spareRepository, $issuerRepository;

    public function __construct(
        ReportRepositoryInterface $reportRepository, 
        CityRepositoryInterface $cityRepository,
        CarNoRepositoryInterface $carNoRepository,
        IssuerRepositoryInterface $issuerRepository,
        DriverRepositoryInterface $driverRepository,
        SpareRepositoryInterface $spareRepository,
    ){
        $this->reportRepository = $reportRepository;
        $this->cityRepository = $cityRepository;
        $this->carNoRepository = $carNoRepository;
        $this->issuerRepository = $issuerRepository;
        $this->driverRepository = $driverRepository;
        $this->spareRepository = $spareRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function index(ReportFilter $filter, Request $request, $type)
    {
        $reports = $this->reportRepository->allWithPaginate($filter, 30, $type);
        $cities = $this->cityRepository->all();

        if ($request->btn == "Export") {
            return Excel::download(new ReportExport($reports), 'report-' . now() . '.xlsx');
        }

        return view('admin.reports.index', compact('reports', 'cities', 'type'));
    }

    public function show($type, Report $report, TrackFilter $filter)
    {
        $tracks = $report->reportTracks()->filter($filter)->get();
        $cities = $this->cityRepository->all();
        $car_nos = $this->carNoRepository->all();
        $issuers = $this->issuerRepository->all();
        $drivers = $this->driverRepository->all();
        $spares = $this->spareRepository->all();

        return view('admin.reports.show', compact('report', 'tracks', 'cities', 'type', 'car_nos', 'issuers', 'drivers', 'spares'));
    }
}
