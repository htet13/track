<?php
namespace App\Repositories\Interfaces;

use App\Filters\SalaryFilter;
use App\Models\Salary;

Interface SalaryRepositoryInterface{
    public function allWithPaginate(SalaryFilter $filter,$paginate);
    public function create();
    public function update(Salary $salary, $data);
}
