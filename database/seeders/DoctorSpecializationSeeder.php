<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctorSpecializationSeeder extends Seeder
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
            $spec=Specialization::inRandomOrder()->limit(2)->get();
            foreach ($spec as $i) $item->specializations()->attach($i->id);
        }
    }
}
