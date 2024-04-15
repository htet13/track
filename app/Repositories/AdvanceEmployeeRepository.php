<?php

namespace App\Repositories;

use Exception;
use App\Models\AdvanceEmployee;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\AdvanceEmployeeRepositoryInterface;

class AdvanceEmployeeRepository implements AdvanceEmployeeRepositoryInterface
{
    public function allWithPaginate($filter,$paginate, $employee_id)
    {
        return AdvanceEmployee::filter($filter)->whereEmployeeId($employee_id)->orderBy('created_at','DESC')->paginate($paginate);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try{
            $advance_employee = AdvanceEmployee::create($data);
            $advance_employee->employee->increment('advance', $data['amount']);
            DB::commit();
            return $advance_employee;
        }catch (Exception $e){
            dd($e);
            DB::rollback();
            return false;
        }
    }

    public function update(AdvanceEmployee $advance_employee, $data)
    {
        DB::beginTransaction();
        try{
            $advance_employee->employee->decrement('advance', $advance_employee->amount);
            $advance_employee->employee->increment('advance', $data['amount']);
            $advance_employee->update($data);
            DB::commit();
            return $advance_employee;
        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
