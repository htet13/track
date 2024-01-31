<?php

namespace App\Http\Controllers\Backend;

use App\Exports\SpareExport;
use App\Filters\SpareFilter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spare;
use App\Repositories\Interfaces\SpareRepositoryInterface;
use App\Http\Requests\SpareStoreRequest;
use App\Http\Requests\SpareUpdateRequest;
use Maatwebsite\Excel\Facades\Excel;

class SpareController extends Controller
{
    protected $spareRepository;

    public function __construct(SpareRepositoryInterface $spareRepository)
    {
        $this->spareRepository = $spareRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function index(SpareFilter $filter, Request $request)
    {
        $spares = $this->spareRepository->allWithPaginate($filter,30);

        if($request->btn == "Export")
        {
            return Excel::download(new SpareExport($spares),'spare'.now().'.xlsx');
        }

        return view('admin.spares.index', compact('spares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.spares.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpareStoreRequest $request)
    {
        $status = $this->spareRepository->create($request->all());

        ($status) ? $message = trans('cruds.spare.title_singular') . ' ' . trans('global.create_success') : $message = trans('cruds.spare.title_singular') . trans('global.create_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.spare.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Spare $spare)
    {
        return view('admin.spares.show', compact('spare'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Spare $spare)
    {
        return view('admin.spares.edit', compact('spare'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SpareUpdateRequest $request, Spare $spare)
    {
        $status = $this->spareRepository->update($spare, $request->all());

        ($status) ? $message = trans('cruds.spare.title_singular') . ' ' . trans('global.update_success') : $message = trans('cruds.spare.title_singular') . trans('global.update_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.spare.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spare $spare)
    {
        $spare->delete();
        
        return redirect()->route('admin.spare.index');
    }
}
