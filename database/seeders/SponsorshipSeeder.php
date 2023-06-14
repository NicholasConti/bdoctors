<?php

namespace Database\Seeders;

use App\Models\Sponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array=[
            ['name'=> 'Basic', 'duration' => 24, 'price' => 2.99],
            ['name'=> 'Medium', 'duration' => 72, 'price' => 5.99],
            ['name'=> 'Premium', 'duration' => 144, 'price' => 9.99]
        ];

        foreach ($array as $item) {
            $newSponsor= new Sponsorship();
            $newSponsor->name=$item['name'];
            $newSponsor->duration=$item['duration'];
            $newSponsor->price=$item['price'];
            $newSponsor->save();
        }
    }
}
