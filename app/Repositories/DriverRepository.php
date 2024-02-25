<?php

namespace App\Repositories;

use Exception;
use App\Models\Driver;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\DriverRepositoryInterface;

class DriverRepository implements DriverRepositoryInterface
{
    public function all()
    {
        return Driver::pluck('name','id');
    }

    public function allWithPaginate($filter,$paginate)
    {
        return Driver::filter($filter)->orderBy('name')->paginate($paginate);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try{
            $driver = Driver::create($data);
            DB::commit();
            return $driver;
        }catch (Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function update(Driver $driver, $data)
    {
        DB::beginTransaction();
        try{
            $driver->update($data);
            DB::commit();
            return $driver;
        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
