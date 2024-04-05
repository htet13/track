<?php

namespace App\Http\Controllers\Backend\Hr;

use App\Enums\{PositionEnum,SalaryTypeEnum};
use App\Exports\EmployeeExport;
use App\Filters\EmployeeFilter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Http\Requests\{EmployeeStoreRequest,ResignRequest};
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    protected $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function index(EmployeeFilter $filter, Request $request, $status)
    {
        $employees = $this->employeeRepository->allWithPaginate($filter,30,$status);
        $positions = PositionEnum::all();
        $salary_types = SalaryTypeEnum::all();

        if($request->btn == "Export")
        {
            return Excel::download(new EmployeeExport($employees),'driver'.now().'.xlsx');
        }

        return view('hr.employees.index', compact('employees','status','positions', 'salary_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($status)
    {
        $positions = PositionEnum::all();
        $salary_types = SalaryTypeEnum::all();
        
        return view('hr.employees.create', compact('positions','status','salary_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeStoreRequest $request, $status)
    {
        $result = $this->employeeRepository->create($request->all());

        ($result) ? $message = trans('cruds.employee.title_singular') . ' ' . trans('global.create_success') : $message = trans('cruds.employee.title_singular') . trans('global.create_fail');

        toast($message,$result ? 'success' : 'error');

        return redirect()->route('hr.employee.index',$status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($status, Employee $employee)
    {
        return view('hr.employees.show', compact('employee','status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($status, Employee $employee)
    {
        $positions = PositionEnum::all();
        $salary_types = SalaryTypeEnum::all();

        return view('hr.employees.edit', compact('employee','positions','status','salary_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeStoreRequest $request, $status, Employee $employee)
    {
        $result = $this->employeeRepository->update($employee, $request->all());

        ($result) ? $message = trans('cruds.employee.title_singular') . ' ' . trans('global.update_success') : $message = trans('cruds.employee.title_singular') . trans('global.update_fail');

        toast($message,$result ? 'success' : 'error');

        return redirect()->route('hr.employee.index', $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($status,Employee $employee)
    {
        $employee->delete();
        
        return redirect()->route('hr.employee.index',$status);
    }

    public function resign(Employee $employee, $status)
    {
        return view('hr.employees.resign', compact('employee','status'));
    }

    public function resignUpdate(ResignRequest $request, Employee $employee, $status)
    {
        $type =  $request->type == 'resign' ? 'resign' : 'new';
        $employee->update([
            'status' => $type, 
            'resign_date' => $request->resign_date,
            'remark' => $request->remark
        ]);

        return redirect()->route('hr.employee.index',$status);
    }
}
