<?php

namespace App\Repositories;

use App\Models\Employee;
use Exception;
use App\Models\Salary;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\SalaryRepositoryInterface;

class SalaryRepository implements SalaryRepositoryInterface
{
    public function allWithPaginate($filter,$paginate)
    {
        return Salary::filter($filter)->orderBy('created_at')->paginate($paginate);
    }

    public function create()
    {
        try{
            DB::beginTransaction();
            
            $data['month'] = date('m')-1;
            $data['year'] = date('m')-1 == 12 ? date('Y')-1 : date('Y');
            $isSynced = Salary::where('month',$data['month'])->where('year',$data['year'])->first();
            
            if(!$isSynced)
            {
                $employeeIds = Employee::whereSalaryType('monthly')->pluck('id');
                foreach($employeeIds as $employeeId)
                {
                    $data['employee_id'] = $employeeId;
                    $salary = Salary::create($data);
                }
            }else{
                $salary = 'Already Exist';
            }
            DB::commit();
            return $salary;
        }catch (Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function update(Salary $salary, $data)
    {
        DB::beginTransaction();
        try{
            $salary->update($data);
            DB::commit();
            return $salary;
        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
