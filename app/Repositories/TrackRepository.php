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
    public function allWithPaginate($filter, $paginate,$type)
    {
        return Track::filter($filter)
            ->whereType($type)
            ->orderBy('created_at', 'DESC')
            ->paginate($paginate);
    }

    public function create($data,$type)
    {
        DB::beginTransaction();
        try {
            $data['type'] = $type;
            $data['total'] = $this->getTotal($data);
            $track = Track::create($data);
            $oldtracks = Report::get();

            $oldtracks = Report::get();

            if ($oldtracks->isEmpty()) {
                $this->createNewReport($data, $type);
            } else {
                $this->updateOrCreateReport($data, $oldtracks, $type);
            }

            $track->fromcities()->sync($data['fromcities']);
            $track->tocities()->sync($data['tocities']);

            // Create and attach other_costs
            if (isset($data['other']['category']) && is_array($data['other']['category'])) {
                $otherCostsData = [];
                for ($i = 0; $i < count($data['other']['category']); $i++) {
                    if ($data['other']['category'][$i] != null) {
                        $otherCostsData[$i]['category'] = $data['other']['category'][$i];
                    }
                    if ($data['other']['category'][$i] != null) {
                        $otherCostsData[$i]['cost'] = $data['other']['cost'][$i];
                    }
                }
                $track->otherCosts()->createMany($otherCostsData);
            }

            // Create and attach oil costs
            if (isset($data['oil']) && is_array($data['oil'])) {
                $oilCostsData = [];
                for ($i = 0; $i < count($data['oil']['liter']); $i++) {
                    $oilCostsData[$i]['liter'] = $data['oil']['liter'][$i];
                    $oilCostsData[$i]['price'] = $data['oil']['price'][$i];
                }
                $track->oilCosts()->createMany($oilCostsData);
            }

            DB::commit();
            return $track;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function update(Track $track, $data, $type)
    {
        DB::beginTransaction();
        try {
            $oldtracks = Report::get();

            foreach ($oldtracks as $oldtrack) {
                $fromcities = $track->fromcities->pluck('id')->toArray() === ($oldtrack->fromcities->pluck('id')->toArray());
                $tocities = $track->tocities->pluck('id')->toArray() === ($oldtrack->tocities->pluck('id')->toArray());
                if ($fromcities && $tocities) {
                    $combineData['total_oil'] = $oldtrack->total_oil - $track->oilCosts->sum('liter');
                    $combineData['total_price'] = $oldtrack->total_price - $track->oilCosts->sum('price');
                    $combineData['other_cost'] = $oldtrack->other_cost - $track->otherCosts->sum('cost');
                    $combineData['times'] = $oldtrack->times - 1;
                    $combineData['expense'] = $oldtrack->expense - $track->expense;
                    $combineData['check_cost'] = $oldtrack->check_cost - $track->check_cost;
                    $combineData['gate_cost'] = $oldtrack->gate_cost - $track->gate_cost;
                    $combineData['food_cost'] = $oldtrack->food_cost - $track->food_cost;
                    $combineData['total'] = $oldtrack->total - $track->total;
                    $oldtrack->update($combineData);
                    break;
                }
            }

            $this->updateOrCreateReport($data, $oldtracks, $type);
            $data['total'] = $this->getTotal($data);
            $track->update($data);
            $track->fromcities()->sync($data['fromcities']);
            $track->tocities()->sync($data['tocities']);

            // Update and attach other_costs
            if (isset($data['other']) && is_array($data['other'])) {
                $otherCostsData = [];
                for ($i = 0; $i < count($data['other']['category']); $i++) {
                    if ($data['other']['category'][$i] != null) {
                        $otherCostsData[$i]['category'] = $data['other']['category'][$i];
                    }
                    if ($data['other']['category'][$i] != null) {
                        $otherCostsData[$i]['cost'] = $data['other']['cost'][$i];
                    }
                }
                $track->otherCosts()->delete();
                $track->otherCosts()->createMany($otherCostsData);
            }

            // Update and attach oil costs
            if (isset($data['oil']) && is_array($data['oil'])) {
                $oilCostsData = [];
                for ($i = 0; $i < count($data['oil']['liter']); $i++) {
                    $oilCostsData[$i]['liter'] = $data['oil']['liter'][$i];
                    $oilCostsData[$i]['price'] = $data['oil']['price'][$i];
                }
                $track->oilCosts()->delete();
                $track->oilCosts()->createMany($oilCostsData);
            }
            DB::commit();
            return $track;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function destroy(Track $track, $type)
    {
        DB::beginTransaction();
        try {
            $oldtracks = Report::get();

            foreach ($oldtracks as $oldtrack) {
                $fromcities = $track->fromcities->pluck('id')->toArray() === ($oldtrack->fromcities->pluck('id')->toArray());
                $tocities = $track->tocities->pluck('id')->toArray() === ($oldtrack->tocities->pluck('id')->toArray());
                if ($fromcities && $tocities) {
                    $combineData['total_oil'] = $oldtrack->total_oil - $track->oilCosts->sum('liter');
                    $combineData['total_price'] = $oldtrack->total_price - $track->oilCosts->sum('price');
                    $combineData['other_cost'] = $oldtrack->other_cost - $track->otherCosts->sum('cost');
                    $combineData['times'] = $oldtrack->times - 1;
                    $combineData['expense'] = $oldtrack->expense - $track->expense;
                    $combineData['check_cost'] = $oldtrack->check_cost - $track->check_cost;
                    $combineData['gate_cost'] = $oldtrack->gate_cost - $track->gate_cost;
                    $combineData['food_cost'] = $oldtrack->food_cost - $track->food_cost;
                    $combineData['total'] = $oldtrack->total - $track->total;
                    $oldtrack->update($combineData);
                    break;
                }
            }

            $track->delete();
            $track->fromcities()->delete();
            $track->tocities()->delete();
            $track->otherCosts()->delete();
            $track->oilCosts()->delete();

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }

    function getTotal($data)
    {
        $total = $data['check_cost'] + $data['gate_cost'] + $data['food_cost'] + array_sum($data['oil']['price']) + array_sum($data['other']['cost']);
        return $total;
    }

    function createNewReport($data, $type)
    {
        $data['type'] = $type;
        $data['total_oil'] = array_sum($data['oil']['liter']);
        $data['total_price'] = array_sum($data['oil']['price']);
        $data['other_cost'] = array_sum($data['other']['cost']);
        $data['total'] = $this->getTotal($data);
        $data['times'] = 1;
        $report = Report::create($data);

        $report->fromcities()->sync($data['fromcities']);
        $report->tocities()->sync($data['tocities']);
    }

    function updateOrCreateReport($data, $oldtracks, $type)
    {
        $isSame = false;
        foreach ($oldtracks as $oldtrack) {
            $fromcities = $data['fromcities'] === ($oldtrack->fromcities->pluck('id')->toArray());
            $tocities = $data['tocities'] === ($oldtrack->tocities->pluck('id')->toArray());
            if ($fromcities && $tocities) {
                $isSame = true;
                $combineData['type'] = $type;
                $combineData['total_oil'] = $oldtrack->total_oil + array_sum($data['oil']['liter']);
                $combineData['total_price'] = $oldtrack->total_price + array_sum($data['oil']['price']);
                $combineData['other_cost'] = $oldtrack->other_cost + array_sum($data['other']['cost']);
                $combineData['times'] = $oldtrack->times + 1;
                $combineData['expense'] = $oldtrack->expense + $data['expense'];
                $combineData['check_cost'] = $oldtrack->check_cost + $data['check_cost'];
                $combineData['gate_cost'] = $oldtrack->gate_cost + $data['gate_cost'];
                $combineData['food_cost'] = $oldtrack->food_cost + $data['food_cost'];
                $combineData['total'] = $oldtrack->total + $this->getTotal($data);
                $nes = $oldtrack->update($combineData);
                break;
            }
        }

        if (!$isSame) {
            $this->createNewReport($data, $type);
        }
    }
}
