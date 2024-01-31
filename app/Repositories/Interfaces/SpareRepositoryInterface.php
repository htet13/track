<?php
namespace App\Repositories\Interfaces;

use App\Filters\SpareFilter;
use App\Models\Spare;

Interface SpareRepositoryInterface{
    public function all();
    public function allWithPaginate(SpareFilter $filter,$paginate);
    public function create($data);
    public function update(Spare $spare, $data);
}
