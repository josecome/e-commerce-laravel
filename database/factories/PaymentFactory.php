<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user_ids = \App\Models\User::pluck('id')->toArray();
        return [
            'amount' => $this->faker->randomFloat(2, 100, 9999),
            'method' => $this->faker->creditCardType(),
            'user_id' => $user_ids[array_rand($user_ids)]
        ];
    }
}
