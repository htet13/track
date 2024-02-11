<?php
namespace App\Repositories\Interfaces;

use App\Filters\TrackFilter;
use App\Models\Track;

Interface TrackRepositoryInterface{
    public function allWithPaginate(TrackFilter $filter, $paginate, $type);
    public function create($data, $type);
    public function update(Track $track, $data, $type);
    public function destroy(Track $track, $type);
}
