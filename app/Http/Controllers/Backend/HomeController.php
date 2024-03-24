<?php

namespace App\Http\Controllers\Backend;

use App\Filters\DriverTrackFilter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\DriverTrack;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home'); 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function logistics(DriverTrackFilter $filter, Request $request)
    {
        // $tracks = Track::filter($filter)
        // ->leftJoin('issuers', function ($join) {
        //     $join->on('tracks.issuer_id', '=', 'issuers.id');
        // })
        // ->selectRaw('
        //     tracks.issuer_id,
        //     SUM(tracks.expense) as total_expense
        // ')
        // ->groupBy('tracks.issuer_id')
        // ->get();

        $tracks = DriverTrack::filter($filter)
        ->where('is_paid', 'paid')
        ->selectRaw('
            driver_tracks.employee_id,
            SUM(driver_tracks.fee) as total_fee
        ')
        ->groupBy('employee_id')
        ->get();

        // dd($tracks);

        return view('admin.dashboard.home', compact('tracks')); 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function hr()
    {
        return redirect()->route('hr.fee.driver'); 
    }
}
