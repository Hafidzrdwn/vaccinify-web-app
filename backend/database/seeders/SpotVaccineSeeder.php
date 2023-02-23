<?php

namespace Database\Seeders;

use App\Models\SpotVaccine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpotVaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SpotVaccine::create([
            'spot_id' => '1',
            'vaccine_id' => '1'
        ]);
        SpotVaccine::create([
            'spot_id' => '2',
            'vaccine_id' => '2'
        ]);
        SpotVaccine::create([
            'spot_id' => '3',
            'vaccine_id' => '3'
        ]);
        SpotVaccine::create([
            'spot_id' => '4',
            'vaccine_id' => '1'
        ]);
        SpotVaccine::create([
            'spot_id' => '5',
            'vaccine_id' => '2'
        ]);
        SpotVaccine::create([
            'spot_id' => '6',
            'vaccine_id' => '3'
        ]);
        SpotVaccine::create([
            'spot_id' => '7',
            'vaccine_id' => '1'
        ]);
    }
}
