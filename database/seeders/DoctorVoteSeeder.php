<?php

namespace Database\Seeders;

use App\Models\Vote;
use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctorVoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctor=Doctor::all();
        foreach ($doctor as $item) {
            $item->votes()->sync(Vote::inRandomOrder()->limit(2)->get());
        }
    }
}
