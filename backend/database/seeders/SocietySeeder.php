<?php

namespace Database\Seeders;

use App\Models\Society;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SocietySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gender = ['male', 'female'];
        for ($i = 1; $i <= 10; $i++) {
            Society::create([
                'id_card_number' => fake()->randomNumber(9, true),
                'password' => Hash::make('password'),
                'name' => fake()->name(),
                'born_date' => fake()->date(),
                'gender' => $gender[rand(0, 1)],
                'address' => fake()->address(),
                'regional_id' => rand(1, 11),
            ]);
        }
    }
}
