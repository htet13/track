<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name'  =>  'Excel Export'],
            ['name'  =>  'Car No Access'],
            ['name'  =>  'City Access'],
            ['name'  =>  'Issuer Access'],
            ['name'  =>  'Driver Access'],
            ['name'  =>  'Spare Access'],
            ['name'  =>  'Track Access'],
            ['name'  =>  'Report Access'],
            ['name'  =>  'User Access'],
        ];

        collect($permissions)->map(function ($permission) {
            Permission::create($permission);
        });
    }
}
