<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class DriverTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $drivers = [
            ['name'  =>  'စိုးကြီး', 'position' => 'driver','joined_date' => '2024-03-11'],
            ['name'  =>  'စိုးသန်း', 'position' => 'driver','joined_date' => '2024-03-11'],
            ['name'  =>  'နောင်နောင်', 'position' => 'driver','joined_date' => '2024-03-11'],
            ['name'  =>  'ဘိုဘို', 'position' => 'driver','joined_date' => '2024-03-11'],
            ['name'  =>  'လမင်း', 'position' => 'driver','joined_date' => '2024-03-11'],
            ['name'  =>  'လမင်းအောင်', 'position' => 'driver','joined_date' => '2024-03-11'],
            ['name'  =>  'ဝင်းထိုက်', 'position' => 'driver', 'joined_date' => '2024-03-11'],
            ['name'  =>  'သိန်းသန်းအောင်', 'position' => 'driver', 'joined_date' => '2024-03-11'],
            ['name'  =>  'ဟိန်းစိုး', 'position' => 'driver', 'joined_date' => '2024-03-11'],
            ['name'  =>  'အရှည်ကြီး', 'position' => 'driver', 'joined_date' => '2024-03-11'],
            ['name'  =>  'အောင်ဇော်ထက်', 'position' => 'driver', 'joined_date' => '2024-03-11'],
            ['name'  =>  'အောင်လေး', 'position' => 'driver', 'joined_date' => '2024-03-11'],
            ['name'  =>  'အောင်သူ', 'position' => 'driver', 'joined_date' => '2024-03-11'],
        ];

        collect($drivers)->map(function ($driver) {
            Employee::create($driver);
        });
    }
}
