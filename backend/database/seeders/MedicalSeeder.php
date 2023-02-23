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
        $role = ['doctor', 'officer'];
        for ($i = 1; $i <= 7; $i++) {
            Medical::create([
                'spot_id' => rand(1, 15),
                'user_id' => rand(1, 7),
                'role' => $role[rand(0, 1)],
                'name' => fake()->name()
            ]);
        }
    }
}
