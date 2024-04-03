<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class SpareTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spares = [
            ['name'  =>  'ကုလား', 'position' => 'spare', 'joined_date' => '2024-03-11'],
            ['name'  =>  'ငဖြိုး', 'position' => 'spare', 'joined_date' => '2024-03-11'],
            ['name'  =>  'စိုးလင်းအောင်', 'position' => 'spare', 'joined_date' => '2024-03-11'],
            ['name'  =>  'ဇေယျာဖြိုး', 'position' => 'spare', 'joined_date' => '2024-03-11'],
            ['name'  =>  'မင်းမင်းလတ်', 'position' => 'spare', 'joined_date' => '2024-03-11'],
            ['name'  =>  'မြတ်မင်း', 'position' => 'spare', 'joined_date' => '2024-03-11'],
            ['name'  =>  'လမင်းထက်', 'position' => 'spare', 'joined_date' => '2024-03-11'],
            ['name'  =>  'လျှံထက်', 'position' => 'spare', 'joined_date' => '2024-03-11'],
            ['name'  =>  'ဝင်းမင်းသူ', 'position' => 'spare', 'joined_date' => '2024-03-11'],
            ['name'  =>  'သူရိန်', 'position' => 'spare', 'joined_date' => '2024-03-11'],
        ];

        collect($spares)->map(function ($spare) {
            Employee::create($spare);
        });
    }
}
