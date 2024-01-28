<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('@dm!nU$er')
        ];

        User::create($users);
    }
}
