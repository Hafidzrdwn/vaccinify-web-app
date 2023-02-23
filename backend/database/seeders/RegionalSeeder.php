<?php

namespace Database\Seeders;

use App\Models\Regional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = [
            'Jakarta' => ['Jakarta Timur', 'Jakarta Barat'],
            'Jawa Timur' => ['Surabaya', 'Sidoarjo', 'Jombang', 'Ponorogo', 'Malang'],
            'Jawa Barat' => ['Bandung'],
            'Bali' => ['Bali'],
            'Sumatera' => ['Padang'],
            'Kalimantan' => ['Pontianak']
        ];

        foreach ($provinces as $province => $districts) {
            foreach ($districts as $district) {
                Regional::create([
                    'province' => $province,
                    'district' => $district
                ]);
            }
        }
    }
}
