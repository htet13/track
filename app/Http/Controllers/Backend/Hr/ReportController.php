<?php

namespace App\Http\Controllers\Backend\Hr;

use App\Http\Controllers\Controller;
use App\Models\AdvanceEmployee;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;
use App\Filters\AdvanceEmployeeFilter;

class ReportController extends Controller
{
    protected $employeeRepository;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
    )
    {
        $this->employeeRepository = $employeeRepository;
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function advanceEmployee(AdvanceEmployeeFilter $filter, Request $request)
    {
        $employees = $this->employeeRepository->allWithoutType();
        
        $advance_employees = AdvanceEmployee::filter($filter)
        ->selectRaw('
            advance_employees.employee_id,
            SUM(advance_employees.amount) as total_amount
        ')
        ->groupBy('employee_id')
        ->paginate(30);

        if($request->btn == "Export")
        {
            return Excel::download(new AdvanceEmployee($advance_employees),'advance-employee'.now().'.xlsx');
        }

        return view('hr.reports.advance_employee', compact('advance_employees','employees')); 
    }
}
