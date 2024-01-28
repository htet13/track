<?php
namespace App\Repositories\Interfaces;

use App\Filters\TrackFilter;
use App\Models\Track;

Interface TrackRepositoryInterface{
    public function all();
    public function allWithPaginate(TrackFilter $filter, $paginate);
    public function create($data);
    public function update(Track $track, $data);
}
