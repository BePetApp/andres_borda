<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $address = \App\Models\Address::inRandomOrder()->first();
        return [
            'user_id' => $address->user_id,
            'address_id' => $address->id,
        ];
    }
}
