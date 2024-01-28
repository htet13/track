<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ['name'  =>  'မိတ္ထီလာ'],
            ['name'  =>  'ပျော်ဘွယ်'],
            ['name'  =>  'ရမည်းသင်း'],
            ['name'  =>  'တပ်ကုန်း'],
            ['name'  =>  'နေပြည်တော်'],
        ];

        collect($cities)->map(function ($city) {
            City::create($city);
        });
    }
}
