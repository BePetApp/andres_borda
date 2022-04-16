<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'town' => $this->faker->word(),
            'neighborhood' => $this->faker->word(),
            'house' => $this->faker->address(),
        ];
    }
}
