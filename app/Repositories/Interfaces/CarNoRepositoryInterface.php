<?php
namespace App\Repositories\Interfaces;

use App\Filters\CarNoFilter;
use App\Models\CarNo;

Interface CarNoRepositoryInterface{
    public function all();
    public function allWithPaginate(CarNoFilter $filter,$paginate);
    public function create($data);
    public function update(CarNo $car_no, $data);
}
