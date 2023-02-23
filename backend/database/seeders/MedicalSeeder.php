<?php

namespace Database\Seeders;

use App\Models\Medical;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medical::create([
            'spot_id' => 1,
            'user_id' => 1,
            'role' => 'doctor',
            'name' => 'Dr. Indah Kusumawati'
        ]);
        Medical::create([
            'spot_id' => 1,
            'user_id' => 2,
            'role' => 'officer',
            'name' => 'Ismail bin Mail'
        ]);
        Medical::create([
            'spot_id' => 2,
            'user_id' => 3,
            'role' => 'doctor',
            'name' => 'Dr. Intan Putri'
        ]);
        Medical::create([
            'spot_id' => 2,
            'user_id' => 4,
            'role' => 'officer',
            'name' => 'Enggar Widagdo'
        ]);
        Medical::create([
            'spot_id' => 3,
            'user_id' => 5,
            'role' => 'doctor',
            'name' => 'Dr. Vanya'
        ]);
        Medical::create([
            'spot_id' => 3,
            'user_id' => 6,
            'role' => 'officer',
            'name' => 'Kevin Ilham'
        ]);
    }
}
