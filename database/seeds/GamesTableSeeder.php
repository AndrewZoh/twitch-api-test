<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = [
            'Starcraft',
            'Fallout: New Vegas'
        ];

        foreach ($games as $game) {
            DB::table('games')->insert([
                'name' => $game,
            ]);
        }

    }
}
