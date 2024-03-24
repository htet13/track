<?php

namespace App\Http\Controllers\Backend\Hr;

use App\Enums\PositionEnum;
use App\Exports\EmployeeExport;
use App\Filters\EmployeeFilter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Http\Requests\EmployeeStoreRequest;
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
    public function index(EmployeeFilter $filter, Request $request)
    {
        $employees = $this->employeeRepository->allWithPaginate($filter,30);

        if($request->btn == "Export")
        {
            return Excel::download(new EmployeeExport($employees),'driver'.now().'.xlsx');
        }

        return view('hr.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = PositionEnum::all();
        
        return view('hr.employees.create', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeStoreRequest $request)
    {
        $status = $this->employeeRepository->create($request->all());

        ($status) ? $message = trans('cruds.employee.title_singular') . ' ' . trans('global.create_success') : $message = trans('cruds.employee.title_singular') . trans('global.create_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('hr.employee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('hr.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $positions = PositionEnum::all();
        return view('hr.employees.edit', compact('employee','positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeStoreRequest $request, Employee $employee)
    {
        $status = $this->employeeRepository->update($employee, $request->all());

        ($status) ? $message = trans('cruds.employee.title_singular') . ' ' . trans('global.update_success') : $message = trans('cruds.employee.title_singular') . trans('global.update_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('hr.employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        
        return redirect()->route('hr.employee.index');
    }
}
