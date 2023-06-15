<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Sponsorship;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctorSponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctor=Doctor::all();
        $date = date("Y-m-d");
        $newDate = date('Y-m-d', strtotime($date. ' + 1 months'));

        foreach ($doctor as $item) {
            $sponsor=Sponsorship::inRandomOrder()->first();
            $item->sponsorships()->attach($sponsor->id,['end_date'=>$newDate]);
        }
    }
}
