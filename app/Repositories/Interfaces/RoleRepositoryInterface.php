<?php
namespace App\Repositories\Interfaces;
use App\Models\Role;

Interface RoleRepositoryInterface{

    public function allRoles();
    public function allRolesWithPaginate($paginate);
    public function store($data);
    public function update(Role $role, $data);
    public function destroy(Role $role);
}
