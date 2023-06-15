<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Review;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Schema::disableForeignKeyConstraints();
        Review::truncate();
        Schema::enableForeignKeyConstraints();

        for($i=0;$i<10;$i++){
            $newReview=new Review();
            $newReview->text_review=$faker->paragraph(1);
            $newReview->name=$faker->name();
            $newReview->surname=$faker->name();
            $newReview->email=$faker->email();
            $doc=Doctor::inRandomOrder()->first();
            $newReview->doctor_id=$doc->id;
            $newReview->save();
        }
    }
}
