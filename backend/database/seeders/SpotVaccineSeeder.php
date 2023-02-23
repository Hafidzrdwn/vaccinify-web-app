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
        for ($i = 1; $i <= 20; $i++) {
            SpotVaccine::create([
                'spot_id' => rand(1, 15),
                'vaccine_id' => rand(1, 3)
            ]);
        }
    }
}
