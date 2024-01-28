<?php
namespace App\Repositories\Interfaces;

use App\Filters\CityFilter;
use App\Models\City;

Interface CityRepositoryInterface{
    public function all();
    public function allWithPaginate(CityFilter $filter,$paginate);
    public function create($data);
    public function update(City $city, $data);
}
