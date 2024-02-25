<?php

namespace App\Repositories;

use Exception;
use App\Models\Issuer;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\IssuerRepositoryInterface;

class IssuerRepository implements IssuerRepositoryInterface
{
    public function all()
    {
        return Issuer::pluck('name','id');
    }

    public function allWithPaginate($filter,$paginate)
    {
        return Issuer::filter($filter)->orderBy('name')->paginate($paginate);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try{
            $issuer = Issuer::create($data);
            DB::commit();
            return $issuer;
        }catch (Exception $e){
            DB::rollback();
            return false;
        }
    }

    public function update(Issuer $issuer, $data)
    {
        DB::beginTransaction();
        try{
            $issuer->update($data);
            DB::commit();
            return $issuer;
        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
