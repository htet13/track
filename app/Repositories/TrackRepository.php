<?php

namespace App\Repositories;

use App\Models\Report;
use Exception;
use App\Models\Track;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\TrackRepositoryInterface;
use Illuminate\Support\Collection;

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
            $oldtracks = Report::get();

            $oldtracks = Report::get();

            if ($oldtracks->isEmpty()) {
                $this->createNewReport($data);
            } else {
                $this->updateOrCreateReport($data, $oldtracks);
            }

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
            $oldtracks = Report::get();

            foreach ($oldtracks as $oldtrack) {
                $fromcities = $track->fromcities->pluck('id')->toArray() === ($oldtrack->fromcities->pluck('id')->toArray());
                $tocities = $track->tocities->pluck('id')->toArray() === ($oldtrack->tocities->pluck('id')->toArray());
                if ($fromcities && $tocities) {
                    $combineData['total_oil'] = $oldtrack->total_oil - $track->oilCosts->sum('liter');
                    $combineData['total_price'] = $oldtrack->total_price - $track->oilCosts->sum('price');
                    $combineData['other_cost'] = $oldtrack->other_cost - $track->otherCosts->sum('cost');
                    $combineData['expense'] = $oldtrack->expense - $data['expense'];
                    $combineData['check_cost'] = $oldtrack->check_cost - $data['check_cost'];
                    $combineData['gate_cost'] = $oldtrack->gate_cost - $data['gate_cost'];
                    $combineData['food_cost'] = $oldtrack->food_cost - $data['food_cost'];
                    $combineData['total'] = $oldtrack->total - $data['total'];
                    $oldtrack->update($combineData);
                    break;
                }
            }

            $this->updateOrCreateReport($data, $oldtracks);

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

    function createNewReport($data)
    {
        $data['total_oil'] = array_sum($data['oil']['liter']);
        $data['total_price'] = array_sum($data['oil']['price']);
        $data['other_cost'] = array_sum($data['other']['cost']);
        $report = Report::create($data);

        $report->fromcities()->sync($data['fromcities']);
        $report->tocities()->sync($data['tocities']);
    }

    function updateOrCreateReport($data, $oldtracks)
    {
        $isSame = false;
        foreach ($oldtracks as $oldtrack) {
            $fromcities = $data['fromcities'] === ($oldtrack->fromcities->pluck('id')->toArray());
            $tocities = $data['tocities'] === ($oldtrack->tocities->pluck('id')->toArray());
            if ($fromcities && $tocities) {
                $isSame = true;
                $combineData['total_oil'] = $oldtrack->total_oil + array_sum($data['oil']['liter']);
                $combineData['total_price'] = $oldtrack->total_price + array_sum($data['oil']['price']);
                $combineData['other_cost'] = $oldtrack->other_cost + array_sum($data['other']['cost']);
                $combineData['expense'] = $oldtrack->expense + $data['expense'];
                $combineData['check_cost'] = $oldtrack->check_cost + $data['check_cost'];
                $combineData['gate_cost'] = $oldtrack->gate_cost + $data['gate_cost'];
                $combineData['food_cost'] = $oldtrack->food_cost + $data['food_cost'];
                $combineData['total'] = $oldtrack->total + $data['total'];
                $oldtrack->update($combineData);
                break;
            }
        }

        if (!$isSame) {
            $this->createNewReport($data);
        }
    }
}
