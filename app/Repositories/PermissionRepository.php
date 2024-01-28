<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\Interfaces\PermissionRepositoryInterface;


class PermissionRepository implements PermissionRepositoryInterface
{

    public function allPermissions()
    {
        return Permission::orderBy('name')->pluck('id', 'name');
    }

}
