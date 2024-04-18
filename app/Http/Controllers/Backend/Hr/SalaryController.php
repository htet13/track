<?php

namespace App\Http\Controllers\Backend\Hr;

use App\Enums\MonthEnum;
use App\Enums\PositionEnum;
use App\Exports\SalaryExport;
use App\Filters\SalaryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalaryStoreRequest;
use App\Models\DriverTrack;
use App\Models\Salary;
use App\Models\SpareTrack;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\Interfaces\SalaryRepositoryInterface;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    protected $salaryRepository, $employeeRepository;

    public function __construct(
        SalaryRepositoryInterface $salaryRepository,
        EmployeeRepositoryInterface $employeeRepository,
    )
    {
        $this->salaryRepository = $salaryRepository;
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function index(SalaryFilter $filter, Request $request)
    {
        $salaries = $this->salaryRepository->allWithPaginate($filter,30);
        $employees = $this->employeeRepository->allWithoutType();
        $months = MonthEnum::all();

        if($request->btn == "Export")
        {
            return Excel::download(new SalaryExport($salaries),'salary-'.now().'.xlsx');
        }

        return view('hr.salaries.index', compact('salaries','employees','months'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function syncEmployee()
    {
        $status = $this->salaryRepository->create();

        if($status == 'Already Exist'){
            toast(trans('month.'.date('m')-1).'လအတွက် ဝန်ထမ်းစာရင်းရှိပြီးဖြစ်ပါသည်။','error');
        }else{
            ($status) ? $message = trans('month.'.date('m')-1).'လအတွက် ဝန်ထမ်းစာရင်း ' . trans('global.create_success') : $message = trans('global.monthly') . trans('global.create_fail');
            toast($message,$status ? 'success' : 'error');
        }

        return redirect()->route('hr.salary.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        return view('hr.salaries.show', compact('salary'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        $employees = $this->employeeRepository->allWithoutType();
        if($salary->employee->position == PositionEnum::DRIVER)
            $drive_tracks = DriverTrack::with('track')
            ->whereEmployeeId($salary->employee_id)
            ->whereHas('track',function($query){
                $query->whereStatus('arrival');
            })
            ->paginate(30);
        else
            $drive_tracks = SpareTrack::with('track')
            ->whereEmployeeId($salary->employee_id)
            ->whereHas('track',function($query){
                $query->whereStatus('arrival');
            })
            ->paginate(30);

        return view('hr.salaries.edit', compact('salary','employees','drive_tracks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SalaryStoreRequest $request, Salary $salary)
    {
        $status = $this->salaryRepository->update($salary, $request->all());

        ($status) ? $message = trans('global.monthly') . ' ' . trans('global.update_success') : $message = trans('global.monthly') . trans('global.update_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('hr.salary.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        $salary->delete();
        
        return redirect()->route('hr.salary.index');
    }
}
