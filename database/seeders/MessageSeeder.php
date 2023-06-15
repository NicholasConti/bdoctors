<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Schema::disableForeignKeyConstraints();
        Message::truncate();
        Schema::enableForeignKeyConstraints();

        for($i=0;$i<10;$i++){
            $newMessage=new Message();
            $newMessage->text_message=$faker->paragraph(1);
            $newMessage->name=$faker->name();
            $newMessage->surname=$faker->name();
            $newMessage->email=$faker->email();
            $doc=Doctor::inRandomOrder()->first();
            $newMessage->doctor_id=$doc->id;
            $newMessage->save();
        }

    }
}
