<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        return $this->call([
            UserSeeder::class,
            VaccineSeeder::class,
            RegionalSeeder::class,
            SocietySeeder::class,
            SpotSeeder::class,
            MedicalSeeder::class,
            SpotVaccineSeeder::class,
        ]);
    }
}
