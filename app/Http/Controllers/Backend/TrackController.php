<?php

namespace App\Http\Controllers\Backend;

use App\Enums\TrackActionModeEnum;
use App\Exports\TrackExport;
use App\Filters\TrackFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\TrackStoreRequest;
use App\Models\Track;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\TrackRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TrackController extends Controller
{
    protected $trackRepository,$cityRepository;

    public function __construct(TrackRepository $trackRepository, CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->trackRepository = $trackRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function index(TrackFilter $filter, Request $request)
    {
        $tracks = $this->trackRepository->allWithPaginate($filter,30);
        $cities = $this->cityRepository->all();

        if($request->btn == "Export")
        {
            return Excel::download(new TrackExport($tracks).'-track'.now().'.xlsx');
        }

        return view('admin.tracks.index', compact('tracks','cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = $this->cityRepository->all();
        return view('admin.tracks.create',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrackStoreRequest $request)
    {        
        $exist = Track::whereFrom($request->from)
        ->whereTo($request->to)
        ->whereStatus('active')
        ->first();
        if ($exist)
        {
            toast('တူညီသောလမ်းကြောင်း ရှိပြီးဖြစ်နေပါသည်။','error');
            return redirect()->route('admin.track.index');
        }
        $status = $this->trackRepository->create($request->all());

        ($status) ? $message = trans('cruds.track.title_singular') . ' ' . trans('global.create_success') : $message = trans('cruds.track.title_singular') . trans('global.create_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.track.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track)
    {
        return view('admin.tracks.show', compact('track'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Track $track)
    {
        $cities = $this->cityRepository->all();
        return view('admin.tracks.edit', compact('track','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TrackStoreRequest $request, Track $track)
    {
        $status = $this->trackRepository->update($track, $request->all());

        ($status) ? $message = trans('cruds.track.title_singular') . ' ' . trans('global.update_success') : $message = trans('cruds.track.title_singular') . trans('global.update_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.track.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Track $track)
    {
        if($track->action_mode == TrackActionModeEnum::ON){
            $track->delete();
            $track->cities()->delete();
        }else{
            $track->update(['status'=> 'inactive']);
        }
        
        return redirect()->route('admin.track.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getInfo(Track $track){
        $track['cities']=$track->cities;
        return response()->json($track);
    }
}
