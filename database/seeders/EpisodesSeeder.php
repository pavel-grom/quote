<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\Episode;
use Illuminate\Database\Seeder;

class EpisodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Episode::count()) {
            return;
        }

        $characterIds = Character::query()->inRandomOrder()->pluck('id');

        Episode::factory()
            ->count(30)
            ->create()
            ->each(function(Episode $episode) use ($characterIds) {
                $randomCharacterIds = $characterIds->random(random_int(5, 15));

                $episode->characters()->sync($randomCharacterIds);
            });
    }
}
