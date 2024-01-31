<?php

namespace App\Http\Controllers\Backend;

use App\Exports\CarNoExport;
use App\Filters\CarNoFilter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarNo;
use App\Repositories\Interfaces\CarNoRepositoryInterface;
use App\Http\Requests\CarNoStoreRequest;
use App\Http\Requests\CarNoUpdateRequest;
use Maatwebsite\Excel\Facades\Excel;

class CarNoController extends Controller
{
    protected $carNoRepository;

    public function __construct(CarNoRepositoryInterface $carNoRepository)
    {
        $this->carNoRepository = $carNoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function index(CarNoFilter $filter, Request $request)
    {
        $car_nos = $this->carNoRepository->allWithPaginate($filter,30);

        if($request->btn == "Export")
        {
            return Excel::download(new CarNoExport($car_nos),'car-no'.now().'.xlsx');
        }

        return view('admin.car_nos.index', compact('car_nos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.car_nos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarNoStoreRequest $request)
    {
        $status = $this->carNoRepository->create($request->all());

        ($status) ? $message = trans('cruds.car_no.title_singular') . ' ' . trans('global.create_success') : $message = trans('cruds.car_no.title_singular') . trans('global.create_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.car-no.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CarNo $car_no)
    {
        return view('admin.car_nos.show', compact('car_no'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CarNo $car_no)
    {
        return view('admin.car_nos.edit', compact('car_no'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarNoUpdateRequest $request, CarNo $car_no)
    {
        $status = $this->carNoRepository->update($car_no, $request->all());

        ($status) ? $message = trans('cruds.car_no.title_singular') . ' ' . trans('global.update_success') : $message = trans('cruds.car_no.title_singular') . trans('global.update_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.car-no.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarNo $car_no)
    {
        $car_no->delete();
        
        return redirect()->route('admin.car-no.index');
    }
}
