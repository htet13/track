<?php

namespace Database\Seeders;

use App\Models\CarNo;
use Illuminate\Database\Seeder;

class CarNoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $car_nos = [
            ['name'  =>  '1Q/3159', 'category' => 'Nissan 410'],
            ['name'  =>  '4Q/3717', 'category' => 'Nissan 380'],
        ];

        collect($car_nos)->map(function ($car_no) {
            CarNo::create($car_no);
        });
    }
}
