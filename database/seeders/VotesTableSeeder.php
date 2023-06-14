<?php

namespace Database\Seeders;

use App\Models\Vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class VotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $votes = [1,2,3,4,5];

        Schema::disableForeignKeyConstraints();
        Vote::truncate();
        Schema::enableForeignKeyConstraints();

        foreach($votes as $vote){
            $newVote = new Vote();
            $newVote->vote = $vote;
            $newVote->save();
        }
    }
}
