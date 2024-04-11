<?php
namespace App\Repositories\Interfaces;

use App\Filters\BonusFilter;
use App\Models\Bonus;

Interface BonusRepositoryInterface{
    public function allWithPaginate(BonusFilter $filter,$paginate);
    public function create($data);
    public function update(Bonus $bonus, $data);
}
