<?php

namespace Database\Seeders;

use App\Models\Issuer;
use Illuminate\Database\Seeder;

class IssuerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $issuers = [
            ['name'  =>  'ACT'],
            ['name'  =>  'Mg win'],
            ['name'  =>  'U kan mg'],
            ['name'  =>  'U Tunmyint'],
        ];

        collect($issuers)->map(function ($issuer) {
            Issuer::create($issuer);
        });
    }
}
