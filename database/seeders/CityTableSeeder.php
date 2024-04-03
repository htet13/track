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
            ['name'  =>  'YGN cp'],
            ['name'  =>  'ညောင်တုန်း အဝေ'],
            ['name'  =>  'တန့်ယန်း'],
            ['name'  =>  'တပ်ကုန်း ပြည်သာနိုင်'],
            ['name'  =>  'မိတ္ထီလာ အနောက်ခြံ'],
            ['name'  =>  'အင်းတကော် sunjin'],
        ];

        collect($cities)->map(function ($city) {
            City::create($city);
        });
    }
}
