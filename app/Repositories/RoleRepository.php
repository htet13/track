<?php

namespace App\Repositories;

use Exception;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\RoleRepositoryInterface;


class RoleRepository implements RoleRepositoryInterface
{

    public function allRoles()
    {
        return Role::pluck('id', 'name');
    }

    public function allRolesWithPaginate($paginate)
    {
        return Role::paginate($paginate);
    }

    public function store($data)
    {
        DB::beginTransaction();

        try{
            $role = Role::create([
                'name'  =>  $data->name,
                'guard_name' => 'web'
            ]);

            $role->permissions()->sync($data->permissions);
            DB::commit();

            return true;
        }catch (Exception $e){
            DB::rollback();
            return false;
        }

    }

    public function update(Role $role, $data)
    {
        DB::beginTransaction();

        try{
            $role->update([
                'name'  =>  $data->name,
            ]);

            $role->permissions()->sync($data->permissions);

            DB::commit();

            return true;
        }catch (Exception $e){
            DB::rollback();
            dd($e);
            return false;
        }
    }

    public function destroy(Role $role)
    {
        if(isset($role)){
            $status = $role->delete();
        }else{
            $status = false;
        }

        return $status;
    }
}
