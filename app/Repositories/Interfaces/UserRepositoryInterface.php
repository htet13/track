<?php
namespace App\Repositories\Interfaces;

use App\Filters\UserFilter;
use App\Models\User;

Interface UserRepositoryInterface{

    public function all(UserFilter $filter,$paginate);
    public function store($data);
    public function update(User $user, $data);
    public function destroy(User $user);
    public function exportExcel();
}
