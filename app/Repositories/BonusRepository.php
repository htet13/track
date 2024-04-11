<?php

namespace App\Repositories;

use Exception;
use App\Models\Bonus;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\BonusRepositoryInterface;

class BonusRepository implements BonusRepositoryInterface
{
    public function allWithPaginate($filter,$paginate)
    {
        return Bonus::filter($filter)->orderBy('created_at')->paginate($paginate);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try{
            $bonus = Bonus::create($data);
            DB::commit();
            return $bonus;
        }catch (Exception $e){
            dd($e);
            DB::rollback();
            return false;
        }
    }

    public function update(Bonus $bonus, $data)
    {
        DB::beginTransaction();
        try{
            $bonus->update($data);
            DB::commit();
            return $bonus;
        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
