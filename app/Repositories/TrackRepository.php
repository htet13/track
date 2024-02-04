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
            if (isset($data['other']['category']) && is_array($data['other']['category'])) {
                $otherCostsData = [];
                for($i=0; $i<count($data['other']['category']); $i++){
                    if($data['other']['category'][$i] != null){
                        $otherCostsData[$i]['category'] = $data['other']['category'][$i];
                    }
                    if($data['other']['category'][$i] != null){
                        $otherCostsData[$i]['cost'] = $data['other']['cost'][$i];
                    }
                }
                $track->otherCosts()->createMany($otherCostsData);
            }

            // Create and attach oil costs
            dd($data['oil']);
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
            $track->fromcities()->sync($data['fromcities']);
            $track->tocities()->sync($data['tocities']);

            // Update and attach other_costs
            if (isset($data['other']) && is_array($data['other'])) {
                $otherCostsData = [];
                for($i=0; $i<count($data['other']['category']); $i++){
                    if($data['other']['category'][$i] != null){
                        $otherCostsData[$i]['category'] = $data['other']['category'][$i];
                    }
                    if($data['other']['category'][$i] != null){
                        $otherCostsData[$i]['cost'] = $data['other']['cost'][$i];
                    }
                }
                $track->otherCosts()->delete();
                $track->otherCosts()->createMany($otherCostsData);
            }

            // Update and attach oil costs
            if (isset($data['oil']) && is_array($data['oil'])) {
                $oilCostsData = [];
                for($i=0; $i<count($data['oil']['liter']); $i++){
                    $oilCostsData[$i]['liter'] = $data['oil']['liter'][$i];
                    $oilCostsData[$i]['price'] = $data['oil']['price'][$i];
                }
                $track->oilCosts()->delete();
                $track->oilCosts()->createMany($oilCostsData);
            }
            DB::commit();
            return $track;
        }catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
