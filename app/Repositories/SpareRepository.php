<?php

namespace App\Repositories;

use Exception;
use App\Models\Spare;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\SpareRepositoryInterface;

class SpareRepository implements SpareRepositoryInterface
{
    public function all()
    {
        return Spare::pluck('name','id');
    }

    public function allWithPaginate($filter,$paginate)
    {
        return Spare::filter($filter)->orderBy('name')->get();
    }

    public function create($data)
    {
        DB::beginTransaction();
        try{
            $spare = Spare::create($data);
            DB::commit();
            return $spare;
        }catch (Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function update(Spare $spare, $data)
    {
        DB::beginTransaction();
        try{
            $spare->update($data);
            DB::commit();
            return $spare;
        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
