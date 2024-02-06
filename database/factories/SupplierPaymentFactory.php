<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SupplierPayment>
 */
class SupplierPaymentFactory extends Factory
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
            'payment_amount' => $this->faker->randomFloat(2, 100, 9999),
            'payment_method' => $this->faker->creditCardType(),
            'supplier_id' => random_int(1, 6),
            'user_id' => $user_ids[array_rand($user_ids)]
        ];
    }
}
