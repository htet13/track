<?php
namespace App\Repositories\Interfaces;

use App\Filters\IssuerFilter;
use App\Models\Issuer;

Interface IssuerRepositoryInterface{
    public function all();
    public function allWithPaginate(IssuerFilter $filter,$paginate);
    public function create($data);
    public function update(Issuer $issuer, $data);
}
