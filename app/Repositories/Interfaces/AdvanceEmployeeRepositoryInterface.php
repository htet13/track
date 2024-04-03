<?php
namespace App\Repositories\Interfaces;

use App\Filters\AdvanceEmployeeFilter;
use App\Models\AdvanceEmployee;

Interface AdvanceEmployeeRepositoryInterface{
    public function allWithPaginate(AdvanceEmployeeFilter $filter,$paginate, $employee_id);
    public function create($data);
    public function update(AdvanceEmployee $advance_employee, $data);
}
