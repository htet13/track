<?php

namespace App\Repositories;

use Exception;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function all($type)
    {
        return Employee::wherePosition($type)->select('name','salary_type','id')->get();
    }

    public function allWithoutType()
    {
        return Employee::pluck('name','id');
    }

    public function allWithPaginate($filter,$paginate,$status)
    {
        return Employee::filter($filter)->whereStatus($status)->orderBy('position')->orderBy('created_at','DESC')->paginate($paginate);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try{
            $Employee = Employee::create($data);
            DB::commit();
            return $Employee;
        }catch (Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function update(Employee $Employee, $data)
    {
        DB::beginTransaction();
        try{
            $Employee->update($data);
            DB::commit();
            return $Employee;
        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
