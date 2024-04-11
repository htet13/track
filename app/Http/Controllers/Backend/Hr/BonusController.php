<?php

namespace App\Http\Controllers\Backend\Hr;

use App\Enums\BonusTypeEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bonus;
use App\Exports\BonusExport;
use App\Filters\BonusFilter;
use App\Http\Requests\BonusStoreRequest;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\Interfaces\BonusRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;

class BonusController extends Controller
{
    protected $bonusRepository, $employeeRepository;

    public function __construct(
        BonusRepositoryInterface $bonusRepository,
        EmployeeRepositoryInterface $employeeRepository,
    )
    {
        $this->bonusRepository = $bonusRepository;
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function index(BonusFilter $filter, Request $request)
    {
        $bonuses = $this->bonusRepository->allWithPaginate($filter,30);
        $employees = $this->employeeRepository->allWithoutType();

        if($request->btn == "Export")
        {
            return Excel::download(new BonusExport($bonuses),'bonus-'.now().'.xlsx');
        }

        return view('hr.bonuses.index', compact('bonuses','employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = $this->employeeRepository->allWithoutType();
        $bonus_types = BonusTypeEnum::all();
        return view('hr.bonuses.create',compact('employees','bonus_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BonusStoreRequest $request)
    {
        $status = $this->bonusRepository->create($request->all());

        ($status) ? $message = trans('cruds.bonus.title_singular') . ' ' . trans('global.create_success') : $message = trans('cruds.bonus.title_singular') . trans('global.create_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('hr.bonuses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bonus $bonus)
    {
        return view('hr.bonuses.show', compact('bonus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bonus $bonus)
    {
        $employees = $this->employeeRepository->allWithoutType();
        $bonus_types = BonusTypeEnum::all();

        return view('hr.bonuses.edit', compact('bonus','employees','bonus_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BonusStoreRequest $request, Bonus $bonus)
    {
        $status = $this->bonusRepository->update($bonus, $request->all());

        ($status) ? $message = trans('cruds.bonus.title_singular') . ' ' . trans('global.update_success') : $message = trans('cruds.bonus.title_singular') . trans('global.update_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('hr.bonuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bonus $bonus)
    {
        $bonus->delete();
        
        return redirect()->route('hr.bonuses.index');
    }
}
