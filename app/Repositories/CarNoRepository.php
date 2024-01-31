<?php

namespace App\Repositories;

use Exception;
use App\Models\CarNo;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\CarNoRepositoryInterface;

class CarNoRepository implements CarNoRepositoryInterface
{
    public function all()
    {
        return CarNo::pluck('name','id');
    }

    public function allWithPaginate($filter,$paginate)
    {
        return CarNo::filter($filter)->paginate($paginate);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try{
            $car_no = CarNo::create($data);
            DB::commit();
            return $car_no;
        }catch (Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function update(CarNo $car_no, $data)
    {
        DB::beginTransaction();
        try{
            $car_no->update($data);
            DB::commit();
            return $car_no;
        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
