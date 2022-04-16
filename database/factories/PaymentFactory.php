<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        return [
            'name' => $user->name,
            'number' => $this->faker->numberBetween(123456, 567890),
            'expiration_date' => now()->addYears(3),
            'document_type' => 'C.C',
            'document' => $this->faker->numberBetween(123456, 999999),
            'user_id' => $user->id,
        ];
    }
}
