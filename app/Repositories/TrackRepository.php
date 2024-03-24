<?php

namespace App\Repositories;

use App\Filters\TrackFilter;
use App\Models\Report;
use Exception;
use App\Models\Track;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\TrackRepositoryInterface;

class TrackRepository implements TrackRepositoryInterface
{
    public function allWithPaginate($filter, $paginate,$type, $status)
    {
        return Track::with('fromcities','tocities','driverTracks','spareTracks','oilCosts','otherCosts')
            ->filter($filter)
            ->whereType($type)
            ->whereStatus($status)
            ->orderBy('created_at', 'DESC')
            ->paginate($paginate);
    }

    public function create($data,$type)
    {
        DB::beginTransaction();
        try {
            $data['type'] = $type;
            $track = Track::create($data);

            $track->fromcities()->sync($data['fromcities']);
            $track->tocities()->sync($data['tocities']);

            // Create and attach driver tracks
            if (isset($data['driver']) && is_array($data['driver'])) {
                $driverTracks = [];
                for ($i = 0; $i < count($data['driver']['driver_id']); $i++) {
                    $driverTracks[$i]['employee_id'] = $data['driver']['driver_id'][$i];
                    $driverTracks[$i]['fee'] = $data['driver']['fee'][$i];
                    // $driverTracks[$i]['is_paid'] = $data['driver']['is_paid'][$i];
                }
                $track->driverTracks()->createMany($driverTracks);
            }

            // Create and attach spare tracks
            if (isset($data['spare']) && is_array($data['spare'])) {
                $spareTracks = [];
                for ($i = 0; $i < count($data['spare']['spare_id']); $i++) {
                    $spareTracks[$i]['employee_id'] = $data['spare']['spare_id'][$i];
                    $spareTracks[$i]['fee'] = $data['spare']['fee'][$i];
                    // $spareTracks[$i]['is_paid'] = $data['spare']['is_paid'][$i];
                }
                $track->spareTracks()->createMany($spareTracks);
            }

            DB::commit();
            return $track;
        } catch (Exception $e) {
            DB::rollback();
            dd($e);
            return false;
        }
    }

    public function update(Track $track, $data, $type)
    {
        DB::beginTransaction();
        try {
            $reportTrackId = DB::table('reports_tracks')->where('track_id',$track->id)->pluck('report_id')->first();
            if($reportTrackId){
                $report = Report::whereId($reportTrackId)->first();
                $renewData = ($report->expense - $track->expense) + $data['expense'];
                $report->update(['expense' => $renewData]);
            }
            $track->update($data);
            $track->fromcities()->sync($data['fromcities']);
            $track->tocities()->sync($data['tocities']);

            // Update and attach driver tracks
            if (isset($data['driver']) && is_array($data['driver'])) {
                $driverTracks = [];
                for ($i = 0; $i < count($data['driver']['driver_id']); $i++) {
                    $driverTracks[$i]['employee_id'] = $data['driver']['driver_id'][$i];
                    $driverTracks[$i]['fee'] = $data['driver']['fee'][$i];
                    // $driverTracks[$i]['is_paid'] = $data['driver']['is_paid'][$i];
                }
                $track->driverTracks()->delete();
                $track->driverTracks()->createMany($driverTracks);
            }

            // Update and attach spare tracks
            if (isset($data['spare']) && is_array($data['spare'])) {
                $spareTracks = [];
                for ($i = 0; $i < count($data['spare']['spare_id']); $i++) {
                    $spareTracks[$i]['employee_id'] = $data['spare']['spare_id'][$i];
                    $spareTracks[$i]['fee'] = $data['spare']['fee'][$i];
                    // $spareTracks[$i]['is_paid'] = $data['spare']['is_paid'][$i];
                }
                $track->spareTracks()->delete();
                $track->spareTracks()->createMany($spareTracks);
            }

            DB::commit();
            return $track;
        } catch (Exception $e) {
            DB::rollback();
            dd($e);
            return false;
        }
    }

    public function arrivalUpdate(Track $track, $data, $type)
    {
        DB::beginTransaction();
        try {
            $oldtracks = Report::get();
            
            $this->checkAlreadyReport($track, $oldtracks);

            if ($oldtracks->isEmpty()) {
                $this->createNewReport($track, $data, $type);
            } else {
                $this->updateOrCreateReport($track, $data, $oldtracks, $type);
            }

            $data['total'] = $this->getTotal($data);
            $data['status'] = 'arrival';
            $track->update($data);

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
            dd($e);
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

    function createNewReport($track, $data, $type)
    {
        $data['type'] = $type;
        $data['total_oil'] = array_sum($data['oil']['liter']);
        $data['total_price'] = array_sum($data['oil']['price']);
        $data['other_cost'] = array_sum($data['other']['cost']);
        $data['expense'] = $track->expense;
        $data['total'] = $this->getTotal($data);
        $data['times'] = 1;
        $report = Report::create($data);

        $report->reportTracks()->sync([$track->id]);
        $report->fromcities()->sync($track->fromcities->pluck('id')->toArray());
        $report->tocities()->sync($track->tocities->pluck('id')->toArray());
    }

    function updateOrCreateReport($track, $data, $oldtracks, $type)
    {
        $isSame = false;
        foreach ($oldtracks as $oldtrack) {
            $fromcities = $track->fromcities->pluck('id')->toArray() === ($oldtrack->fromcities->pluck('id')->toArray());
            $tocities = $track->tocities->pluck('id')->toArray() === ($oldtrack->tocities->pluck('id')->toArray());
            if ($fromcities && $tocities) {
                $isSame = true;
                $combineData['type'] = $type;
                $combineData['total_oil'] = $oldtrack->total_oil + array_sum($data['oil']['liter']);
                $combineData['total_price'] = $oldtrack->total_price + array_sum($data['oil']['price']);
                $combineData['other_cost'] = $oldtrack->other_cost + array_sum($data['other']['cost']);
                $combineData['times'] = $oldtrack->times + 1;
                $combineData['expense'] = $oldtrack->expense + $track->expense;
                $combineData['check_cost'] = $oldtrack->check_cost + $data['check_cost'];
                $combineData['gate_cost'] = $oldtrack->gate_cost + $data['gate_cost'];
                $combineData['food_cost'] = $oldtrack->food_cost + $data['food_cost'];
                $combineData['total'] = $oldtrack->total + $this->getTotal($data);
                $oldtrack->update($combineData);
                DB::table('reports_tracks')->insert(['track_id' => $track->id, 'report_id' => $oldtrack->id]);
                break;
            }
        }

        if (!$isSame) {
            $this->createNewReport($track, $data, $type);
        }
    }

    function checkAlreadyReport($track, $oldtracks)
    {
        $reportTrack = DB::table('reports_tracks')->where('track_id',$track->id)->get();
        if(!$reportTrack->isEmpty()){
            DB::table('reports_tracks')->where('track_id',$track->id)->delete();
            foreach ($oldtracks as $oldtrack) {
                $fromcities = $track->fromcities->pluck('id')->toArray() === ($oldtrack->fromcities->pluck('id')->toArray());
                $tocities = $track->tocities->pluck('id')->toArray() === ($oldtrack->tocities->pluck('id')->toArray());
                if ($fromcities && $tocities) {
                    $combineData['total_oil'] = $oldtrack->total_oil - $track->oilCosts->sum('liter');
                    $combineData['total_price'] = $oldtrack->total_price - $track->oilCosts->sum('price');
                    $combineData['other_cost'] = $oldtrack->other_cost - $track->otherCosts->sum('cost');
                    $combineData['times'] = $oldtrack->times - 1;
                    $combineData['check_cost'] = $oldtrack->check_cost - $track->check_cost;
                    $combineData['gate_cost'] = $oldtrack->gate_cost - $track->gate_cost;
                    $combineData['food_cost'] = $oldtrack->food_cost - $track->food_cost;
                    $combineData['total'] = $oldtrack->total - $track->total;
                    $oldtrack->update($combineData);
                    break;
                }
            }
        }
    }
}
