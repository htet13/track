<?php

namespace App\Http\Controllers\Backend;

use App\Exports\IssuerExport;
use App\Filters\IssuerFilter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Issuer;
use App\Repositories\Interfaces\IssuerRepositoryInterface;
use App\Http\Requests\IssuerStoreRequest;
use App\Http\Requests\IssuerUpdateRequest;
use Maatwebsite\Excel\Facades\Excel;

class IssuerController extends Controller
{
    protected $issuerRepository;

    public function __construct(issuerRepositoryInterface $issuerRepository)
    {
        $this->issuerRepository = $issuerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function index(IssuerFilter $filter, Request $request)
    {
        $issuers = $this->issuerRepository->allWithPaginate($filter,30);

        if($request->btn == "Export")
        {
            return Excel::download(new IssuerExport($issuers),'issuer'.now().'.xlsx');
        }

        return view('admin.issuers.index', compact('issuers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.issuers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IssuerStoreRequest $request)
    {
        $status = $this->issuerRepository->create($request->all());

        ($status) ? $message = trans('cruds.issuer.title_singular') . ' ' . trans('global.create_success') : $message = trans('cruds.issuer.title_singular') . trans('global.create_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.issuer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Issuer $issuer)
    {
        return view('admin.issuers.show', compact('issuer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Issuer $issuer)
    {
        return view('admin.issuers.edit', compact('issuer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IssuerUpdateRequest $request, Issuer $issuer)
    {
        $status = $this->issuerRepository->update($issuer, $request->all());

        ($status) ? $message = trans('cruds.issuer.title_singular') . ' ' . trans('global.update_success') : $message = trans('cruds.issuer.title_singular') . trans('global.update_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('admin.issuer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issuer $issuer)
    {
        $issuer->delete();
        
        return redirect()->route('admin.issuer.index');
    }
}
