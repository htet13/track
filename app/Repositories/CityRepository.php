<?php

namespace App\Repositories;

use Exception;
use App\Models\City;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\CityRepositoryInterface;

class CityRepository implements CityRepositoryInterface
{
    public function all()
    {
        return City::pluck('name','id');
    }

    public function allWithPaginate($filter,$paginate)
    {
        return City::filter($filter)->paginate($paginate);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try{
            $city = City::create($data);
            DB::commit();
            return $city;
        }catch (Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function update(City $city, $data)
    {
        DB::beginTransaction();
        try{
            $city->update($data);
            DB::commit();
            return $city;
        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
