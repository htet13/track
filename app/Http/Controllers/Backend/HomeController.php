<?php

namespace App\Http\Controllers\Backend;

use App\Enums\IntervalEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Summary;
use App\Models\Purchase;
use App\Models\Sale;
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
    public function index(Request $request)
    {
        $profits = [];
        $track1 = [];
        $track2 = [];
    
        return view('admin.dashboard.home', compact('track1','track2','profits')); // Pass $interval to the view.
    }

}
