<?php

namespace App\Http\Controllers\Backend\Hr;

use App\Exports\AdvanceEmployeeExport;
use App\Filters\AdvanceEmployeeFilter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdvanceEmployee;
use App\Repositories\Interfaces\AdvanceEmployeeRepositoryInterface;
use App\Http\Requests\AdvanceEmployeeStoreRequest;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;

class AdvanceEmployeeController extends Controller
{
    protected $advanceEmployeeRepository,$employeeRepository;

    public function __construct(
        AdvanceEmployeeRepositoryInterface $advanceEmployeeRepository,
        EmployeeRepositoryInterface $employeeRepository,
    )
    {
        $this->advanceEmployeeRepository = $advanceEmployeeRepository;
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return Collection
     */
    public function index(AdvanceEmployeeFilter $filter, Request $request)
    {
        $employee_id = $request->employee_id ?? 1;
        $advance_employees = $this->advanceEmployeeRepository->allWithPaginate($filter,30,$employee_id);
        $employees = $this->employeeRepository->allWithoutType();

        if($request->btn == "Export")
        {
            return Excel::download(new AdvanceEmployeeExport($advance_employees),'advance-employee'.now().'.xlsx');
        }

        return view('hr.advance_employees.index', compact('advance_employees','employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = $this->employeeRepository->allWithoutType();
        return view('hr.advance_employees.create',compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvanceEmployeeStoreRequest $request)
    {
        $status = $this->advanceEmployeeRepository->create($request->all());

        ($status) ? $message = trans('cruds.advance_employee.title_singular') . ' ' . trans('global.create_success') : $message = trans('cruds.advance_employee.title_singular') . trans('global.create_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('hr.advance-employee.index', ['employee_id' => $request->employee_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AdvanceEmployee $advance_employee)
    {
        return view('hr.advance_employees.show', compact('advance_employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AdvanceEmployee $advance_employee)
    {
        $employees = $this->employeeRepository->allWithoutType();
        return view('hr.advance_employees.edit', compact('advance_employee','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdvanceEmployeeStoreRequest $request, AdvanceEmployee $advance_employee)
    {
        $status = $this->advanceEmployeeRepository->update($advance_employee, $request->all());

        ($status) ? $message = trans('cruds.advance_employee.title_singular') . ' ' . trans('global.update_success') : $message = trans('cruds.advance_employee.title_singular') . trans('global.update_fail');

        toast($message,$status ? 'success' : 'error');

        return redirect()->route('hr.advance-employee.index', ['employee_id' => $advance_employee->employee_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdvanceEmployee $advance_employee)
    {
        $advance_employee->delete();
        
        return redirect()->route('hr.advance-employee.index', ['employee_id' => $advance_employee->employee_id]);
    }
}
