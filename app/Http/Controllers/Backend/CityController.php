<?php

namespace App\Http\Controllers\Backend;

use App\Exports\CityExport;
use App\Filters\CityFilter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Http\Requests\CityStoreRequest;
use App\Http\Requests\CityUpdateRequest;
use Maatwebsite\Excel\Facades\Excel;

class CityController extends Controller
{
    protected $cityRepository;

    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function index(CityFilter $filter, Request $request)
    {
        $cities = $this->cityRepository->allWithPaginate($filter,30);

        if($request->btn == "Export")
        {
            return Excel::download(new CityExport($cities),'city'.now().'.xlsx');
        }

        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityStoreRequest $request)
    {
        $status = $this->cityRepository->create($request->all());

        ($status) ? $message = trans('cruds.city.title_singular') . ' ' . trans('global.create_success') : $message = trans('cruds.city.title_singular') . trans('global.create_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.city.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return view('admin.cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        return view('admin.cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityUpdateRequest $request, City $city)
    {
        $status = $this->cityRepository->update($city, $request->all());

        ($status) ? $message = trans('cruds.city.title_singular') . ' ' . trans('global.update_success') : $message = trans('cruds.city.title_singular') . trans('global.update_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.city.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        
        return redirect()->route('admin.city.index');
    }
}
