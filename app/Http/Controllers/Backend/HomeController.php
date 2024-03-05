<?php

namespace App\Http\Controllers\Backend;

use App\Enums\IntervalEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Filters\ReportFilter;
use App\Models\SpareTrack;
use App\Models\Track;
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
    public function index(ReportFilter $filter, Request $request)
    {
        $tracks = Track::filter($filter)
        ->leftJoin('issuers', function ($join) {
            $join->on('tracks.issuer_id', '=', 'issuers.id');
        })
        ->selectRaw('
            tracks.issuer_id,
            SUM(tracks.expense) as total_expense
        ')
        ->groupBy('tracks.issuer_id')
        ->get();

        return view('admin.dashboard.home', compact('tracks')); 
    }

}
