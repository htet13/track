<?php
namespace App\Repositories\Interfaces;

use App\Filters\DriverFilter;
use App\Models\Driver;

Interface DriverRepositoryInterface{
    public function all();
    public function allWithPaginate(DriverFilter $filter,$paginate);
    public function create($data);
    public function update(Driver $driver, $data);
}
