<?php

namespace App\Repositories;

use Exception;
use App\Models\Track;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\TrackRepositoryInterface;

class TrackRepository implements TrackRepositoryInterface
{
    public function all()
    {
        return Track::get();
    }

    public function allWithPaginate($filter, $paginate)
    {
        return Track::filter($filter)
        ->orderBy('created_at','DESC')
        ->paginate($paginate);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try{
            $track = Track::create($data);
            $track->fromcities()->sync($data['fromcities']);
            $track->tocities()->sync($data['tocities']);

            // Create and attach other_costs
            if (isset($data['others']) && is_array($data['others'])) {
                $otherCostsData = [];
                for($i=0; $i<count($data['others']['category']); $i++){
                    $otherCostsData[$i]['category'] = $data['others']['category'][$i];
                    $otherCostsData[$i]['cost'] = $data['others']['cost'][$i];
                }
                $track->otherCosts()->createMany($otherCostsData);
            }

            // Create and attach oil costs
            if (isset($data['oil']) && is_array($data['oil'])) {
                $oilCostsData = [];
                for($i=0; $i<count($data['oil']['liter']); $i++){
                    $oilCostsData[$i]['liter'] = $data['oil']['liter'][$i];
                    $oilCostsData[$i]['price'] = $data['oil']['price'][$i];
                }
                $track->oilCosts()->createMany($oilCostsData);
            }

            DB::commit();
            return $track;
        }catch (Exception $e){
            dd($e);
            DB::rollback();
            return false;
        }
    }

    public function update(Track $track, $data)
    {
        DB::beginTransaction();
        try{
            $track->update($data);
            $track->cities()->sync($data['others']);
            DB::commit();
            return $track;
        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
