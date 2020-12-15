<?php

namespace Database\Factories;

use App\Models\Character;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    protected $model = Character::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'birthday' => $this->faker->dateTimeThisCentury->format('Y-m-d'),
            'occupations' => $this->faker->words(random_int(3, 5)),
            'img' => $this->faker->imageUrl(250, 250, 'people'),
            'nickname' => $this->faker->userName,
            'portrayed' => $this->faker->name,
        ];
    }
}
