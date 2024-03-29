<?php
namespace App\Repositories\Interfaces;

use App\Filters\EmployeeFilter;
use App\Models\Employee;

Interface EmployeeRepositoryInterface{
    public function all($type);
    public function allWithPaginate(EmployeeFilter $filter,$paginate,$status);
    public function create($data);
    public function update(Employee $employee, $data);
}
