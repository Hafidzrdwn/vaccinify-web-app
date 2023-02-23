<?php

namespace Database\Seeders;

use App\Models\Consultation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = ['pending', 'accepted', 'rejected'];
        for ($i = 1; $i <= 25; $i++) {
            Consultation::create([
                'society_id' => rand(1, 10),
                'doctor_id' => rand(1, 7),
                'status' => $status[rand(0, 2)],
                'disease_history' => fake()->words(3, true),
                'current_symptoms' => fake()->words(5, true),
                'doctor_notes' => fake()->sentence(),
            ]);
        }
    }
}
