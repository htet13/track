<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the 'admin' role
        $adminRole = Role::create(['name' => 'admin']);

        // Get all permissions
        $permissions = Permission::all();

        // Give all permissions to the 'admin' role
        $adminRole->syncPermissions($permissions);
    }
}
