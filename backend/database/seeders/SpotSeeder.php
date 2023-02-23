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
        Spot::create([
            'regional_id' => 1,
            'name' => 'RSAL Tadika Mesra',
            'Address' => 'Jln. Indah Kusumawati',
            'serve' => 2,
            'capacity' => 100
        ]);
        Spot::create([
            'regional_id' => 1,
            'name' => 'RSUD Soetomo',
            'Address' => 'Jln. Mayjen Sungkono',
            'serve' => 2,
            'capacity' => 256
        ]);
        Spot::create([
            'regional_id' => 2,
            'name' => 'RSUD Bundawati',
            'Address' => 'Jln. Bunda Kematian',
            'serve' => 1,
            'capacity' => 115
        ]);
        Spot::create([
            'regional_id' => 3,
            'name' => 'RSUD Mangun Karso',
            'Address' => 'Jln. Prof Karsono',
            'serve' => 3,
            'capacity' => 125
        ]);
        Spot::create([
            'regional_id' => 4,
            'name' => 'RSI Muhammadiyah',
            'Address' => 'Jln. Pandaan',
            'serve' => 2,
            'capacity' => 67
        ]);
        Spot::create([
            'regional_id' => 5,
            'name' => 'RSUD Abdi Negara',
            'Address' => 'Jln. Sutomo',
            'serve' => 1,
            'capacity' => 28
        ]);
        Spot::create([
            'regional_id' => 6,
            'name' => 'RSUD Hadi Raharjo',
            'Address' => 'Jln. Anggrek Kusuma',
            'serve' => 2,
            'capacity' => 145
        ]);
        Spot::create([
            'regional_id' => 7,
            'name' => 'RSUD Soerya',
            'Address' => 'Jln. Jatinegara',
            'serve' => 2,
            'capacity' => 176
        ]);
    }
}
