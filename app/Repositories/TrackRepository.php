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
        return Track::whereStatus('active')->get();
    }

    public function allWithPaginate($filter, $paginate)
    {
        return Track::filter($filter)
        ->whereStatus('active')
        ->paginate($paginate);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try{
            $track = Track::create($data);
            $track->cities()->sync($data['others']);
            DB::commit();
            return $track;
        }catch (Exception $e){
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
