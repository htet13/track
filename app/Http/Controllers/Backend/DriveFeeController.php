<?php

namespace App\Http\Controllers\Backend;

use App\Exports\DriverTrackExport;
use App\Exports\SpareTrackExport;
use App\Filters\DriverTrackFeeFilter;
use App\Filters\DriverTrackFilter;
use App\Filters\SpareTrackFilter;
use App\Http\Controllers\Controller;
use App\Models\DriverTrack;
use App\Models\Track;
use Illuminate\Support\Facades\DB;
use App\Models\SpareTrack;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\CarNoRepositoryInterface;
use App\Repositories\Interfaces\IssuerRepositoryInterface;
use App\Repositories\Interfaces\DriverRepositoryInterface;
use App\Repositories\Interfaces\SpareRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Filters\TrackFilter;

class DriveFeeController extends Controller
{
    protected $cityRepository, $carNoRepository, $driverRepository, $spareRepository, $issuerRepository;

    public function __construct(
        CityRepositoryInterface $cityRepository, 
        CarNoRepositoryInterface $carNoRepository,
        IssuerRepositoryInterface $issuerRepository,
        DriverRepositoryInterface $driverRepository,
        SpareRepositoryInterface $spareRepository,
    ){
        $this->cityRepository = $cityRepository;
        $this->carNoRepository = $carNoRepository;
        $this->issuerRepository = $issuerRepository;
        $this->driverRepository = $driverRepository;
        $this->spareRepository = $spareRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function driver(DriverTrackFilter $filter, Request $request)
    {
        $drivers = $this->driverRepository->all();
        
        $driver_tracks = DriverTrack::filter($filter)->select(
            'driver_id',
            DB::raw('SUM(CASE WHEN is_paid = "paid" THEN 1 ELSE 0 END) as paid_track_count'),
            DB::raw('SUM(CASE WHEN is_paid = "unpaid" THEN 1 ELSE 0 END) as unpaid_track_count'),
            DB::raw('SUM(CASE WHEN is_paid = "paid" THEN fee ELSE 0 END) as paid_fee_sum'),
            DB::raw('SUM(CASE WHEN is_paid = "unpaid" THEN fee ELSE 0 END) as unpaid_fee_sum')
        )
        ->groupBy('driver_id')
        ->paginate(30);

        if($request->btn == "Export")
        {
            return Excel::download(new DriverTrackExport($driver_tracks),'driver-track'.now().'.xlsx');
        }

        return view('admin.drive_fees.driver.index', compact('driver_tracks','drivers')); 
    }

    public function driverDetail(DriverTrackFeeFilter $filter, $driver_id )
    {
        $cities = $this->cityRepository->all();
        $car_nos = $this->carNoRepository->all();
        $issuers = $this->issuerRepository->all();
        $drivers = $this->driverRepository->all();
        $spares = $this->spareRepository->all();

        $driver_tracks = DriverTrack::with('track')->filter($filter)
            ->whereDriverId($driver_id)
            ->paginate(30);

        return view('admin.drive_fees.driver.track_detail',compact('driver_tracks','driver_id','cities','car_nos','issuers','drivers','spares'));
    }

    public function driverEdit($track_id )
    {
        $driver_track = DriverTrack::with('track')
            ->whereTrackId($track_id)
            ->first();

        return view('admin.drive_fees.driver.track_edit',compact('driver_track'));
    }

    public function driverUpdate(DriverTrack $driver_track, Request $request )
    {
        $uuu = $driver_track->update([
            'is_paid' => $request->is_paid, 
            'remark' => $request->remark, 
            'payment_date' => $request->payment_date ?? now()
        ]);

        return redirect()->route('admin.fee.driver.detail',['driver_id' => $driver_track->driver_id, 'driver_is_paid' => $request->is_paid]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function spare(SpareTrackFilter $filter, Request $request)
    {
        $spares = $this->spareRepository->all();

        $spare_tracks = SpareTrack::filter($filter)->select(
            'spare_id',
            DB::raw('SUM(CASE WHEN is_paid = "paid" THEN 1 ELSE 0 END) as paid_track_count'),
            DB::raw('SUM(CASE WHEN is_paid = "unpaid" THEN 1 ELSE 0 END) as unpaid_track_count'),
            DB::raw('SUM(CASE WHEN is_paid = "paid" THEN fee ELSE 0 END) as paid_fee_sum'),
            DB::raw('SUM(CASE WHEN is_paid = "unpaid" THEN fee ELSE 0 END) as unpaid_fee_sum')
        )
        ->groupBy('spare_id')
        ->paginate(30);

        if($request->btn == "Export")
        {
            return Excel::download(new SpareTrackExport($spare_tracks),'driver-track'.now().'.xlsx');
        }

        return view('admin.drive_fees.spare.index', compact('spare_tracks','spares')); 
    }

    public function spareDetail(DriverTrackFeeFilter $filter, $spare_id)
    {
        $cities = $this->cityRepository->all();
        $car_nos = $this->carNoRepository->all();
        $issuers = $this->issuerRepository->all();
        $drivers = $this->driverRepository->all();
        $spares = $this->spareRepository->all();

        $spare_tracks = SpareTrack::with('track')->filter($filter)
            ->whereSpareId($spare_id)
            ->paginate(30);

        return view('admin.drive_fees.spare.track_detail',compact('spare_tracks','spare_id','cities','car_nos','issuers','drivers','spares'));
    }

    public function spareEdit($track_id )
    {
        $spare_track = SpareTrack::with('track')
            ->whereTrackId($track_id)
            ->first();

        return view('admin.drive_fees.spare.track_edit',compact('spare_track'));
    }

    public function spareUpdate(SpareTrack $spare_track, Request $request )
    {
        $spare_track->update([
            'is_paid' => $request->is_paid, 
            'remark' => $request->remark, 
            'payment_date' => $request->payment_date ?? now()
        ]);

        return redirect()->route('admin.fee.spare.detail',[$spare_track->spare_id, 'driver_is_paid' => $request->is_paid]);
    }

}
