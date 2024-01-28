<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function all($filter,$paginate)
    {
        return User::with('roles')
        ->filter($filter)
        ->paginate($paginate);
    }

    public function store($data)
    {
        DB::beginTransaction();

        try{
            $roles = Role::whereIn('id',$data->roles)->select('name')->get();
            $user = User::create([
                'name'  =>  $data->name,
                'email' =>  $data->email,
                'password' => bcrypt($data->password)
            ]);

            foreach($roles as $role){
                $user->assignRole($role->name);
            }

            DB::commit();

            return $user;
        }catch (Exception $e){
            DB::rollback();
            return false;
        }

    }

    public function update(User $user, $data)
    {
        DB::beginTransaction();

        try{
            $roles = Role::whereIn('id',$data->roles)->select('name')->get();

            $user->update([
                'name'  =>  $data->name,
                'email' =>  $data->email,
                'password' => bcrypt($data->password)
            ]);

            $role_arr = [];
            foreach($roles as $role){
                array_push($role_arr, $role->name);
            }

            $user->syncRoles($role_arr);

            DB::commit();

            return $user;
        }catch (Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function destroy(User $user)
    {
        if(isset($user)){
            $user->syncRoles([]);
            $status = $user->delete();
        }else{
            $status = false;
        }

        return $status;
    }

    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
