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
        $this->call([
            SpecializationSeeder::class,
            SponsorshipSeeder::class,
            VotesTableSeeder::class,
            MessageSeeder::class,
            ReviewSeeder::class,
            SpecializationSeeder::class,
            SponsorshipSeeder::class,
            DoctorVoteSeeder::class,
            DoctorSponsorshipSeeder::class,
            DoctorSpecializationSeeder::class
        ]);
    }
}
