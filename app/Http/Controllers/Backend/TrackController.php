<?php

namespace App\Http\Controllers\Backend;

use App\Exports\TrackExport;
use App\Filters\TrackFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\{TrackDepartureRequest, TrackArrivalRequest};
use App\Models\Track;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\CarNoRepositoryInterface;
use App\Repositories\Interfaces\IssuerRepositoryInterface;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\TrackRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Enums\PositionEnum;

class TrackController extends Controller
{
    protected $trackRepository, $cityRepository, $carNoRepository, $employeeRepository, $issuerRepository;

    public function __construct(
        TrackRepository $trackRepository, 
        CityRepositoryInterface $cityRepository, 
        CarNoRepositoryInterface $carNoRepository,
        IssuerRepositoryInterface $issuerRepository,
        EmployeeRepositoryInterface $employeeRepository,
    ){
        $this->cityRepository = $cityRepository;
        $this->carNoRepository = $carNoRepository;
        $this->issuerRepository = $issuerRepository;
        $this->employeeRepository = $employeeRepository;
        $this->trackRepository = $trackRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TrackFilter $filter, Request $request, $type, $status)
    {
        $tracks = $this->trackRepository->allWithPaginate($filter, 30, $type, $status);
        $cities = $this->cityRepository->all();
        $car_nos = $this->carNoRepository->all();
        $issuers = $this->issuerRepository->all();
        $drivers = $this->employeeRepository->all(PositionEnum::DRIVER);
        $spares = $this->employeeRepository->all(PositionEnum::SPARE);

        if ($request->btn == "Export") {
            return Excel::download(new TrackExport($tracks), 'track' . now() . '.xlsx');
        }

        return view('admin.tracks.index', compact('tracks', 'cities', 'type', 'status', 'car_nos', 'issuers', 'drivers', 'spares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        $cities = $this->cityRepository->all();
        $car_nos = $this->carNoRepository->all();
        $issuers = $this->issuerRepository->all();
        $drivers = $this->employeeRepository->all(PositionEnum::DRIVER);
        $spares = $this->employeeRepository->all(PositionEnum::SPARE);
        return view('admin.tracks.create', compact('cities','car_nos','issuers','drivers','spares','type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrackDepartureRequest $request, $type)
    {
        $success = $this->trackRepository->create($request->all(),$type);

        ($success) ? $message = trans('cruds.track.title_singular') . ' ' . trans('global.create_success') : $message = trans('cruds.track.title_singular') . trans('global.create_fail');

        toast($message, $success ? 'success' : 'error');

        return redirect()->route('admin.track.index', [$type,'departure']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type, $status, Track $track)
    {
        return view('admin.tracks.show', compact('track','type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($type, $status, Track $track)
    {
        $cities = $this->cityRepository->all();
        $car_nos = $this->carNoRepository->all();
        $issuers = $this->issuerRepository->all();
        $drivers = $this->employeeRepository->all(PositionEnum::DRIVER);
        $spares = $this->employeeRepository->all(PositionEnum::SPARE);
        return view('admin.tracks.edit', compact('track', 'cities', 'car_nos','issuers','drivers','spares', 'type'));
    }

    public function arrivalEdit($type, $status, Track $track)
    {
        return view('admin.tracks._arrival_form', compact('track','type','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TrackDepartureRequest $request, $type, $status, Track $track)
    {
        $success = $this->trackRepository->update($track, $request->all(), $type);

        ($success) ? $message = trans('cruds.track.title_singular') . ' ' . trans('global.update_success') : $message = trans('cruds.track.title_singular') . trans('global.update_fail');

        toast($message, $success ? 'success' : 'error');

        return redirect()->route('admin.track.index', [$type,'departure']);
    }

    public function arrivalUpdate(TrackArrivalRequest $request, $type, Track $track)
    {
        $success = $this->trackRepository->arrivalUpdate($track, $request->all(), $type);

        ($success) ? $message = trans('cruds.track.title_singular') . ' ' . trans('global.update_success') : $message = trans('cruds.track.title_singular') . trans('global.update_fail');

        toast($message, $success ? 'success' : 'error');

        return redirect()->route('admin.track.index', [$type,'arrival']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type, $status, Track $track)
    {
        $this->trackRepository->destroy($track, $type);

        return redirect()->route('admin.track.index', [$type,'departure']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getInfo(Track $track)
    {
        $track['cities'] = $track->cities;
        return response()->json($track);
    }
}
