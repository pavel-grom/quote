<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\Quote;
use Illuminate\Database\Seeder;

class QuotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $characters = Character::with('episodes')->get();

        foreach ($characters as $character) {
            if ($character->episodes->count() === 0) {
                continue;
            }

            $randomEpisode = $character->episodes->random();

            Quote::factory()
                ->count(random_int(3, 7))
                ->create([
                    'episode_id' => $randomEpisode->id,
                    'character_id' => $character->id,
                ]);
        }
    }
}
