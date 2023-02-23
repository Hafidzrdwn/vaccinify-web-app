<?php

namespace Database\Seeders;

use App\Models\Vaccine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vaccines = ['Astrazeneca', 'Booster', 'Sinovac'];

        foreach ($vaccines as $vaccine) {
            Vaccine::create([
                'name' => $vaccine
            ]);
        }
    }
}
