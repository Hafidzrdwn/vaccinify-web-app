<?php

namespace Database\Seeders;

use App\Models\Spot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 15; $i++) {
            Spot::create([
                'regional_id' => rand(1, 11),
                'name' => 'RS ' . fake()->city(),
                'Address' => fake()->streetAddress(),
                'serve' => rand(1, 3),
                'capacity' => rand(1, 250)
            ]);
        }
    }
}
