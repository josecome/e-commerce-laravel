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
        $payment_ids = \App\Models\Cart::pluck('payment_id')->toArray();
        return [
            'amount' => $this->faker->randomFloat(2, 100, 9999),
            'cart_payment_id' => $payment_ids[array_rand($payment_ids)],
            'user_id' => random_int(1, 6)
        ];
    }
}
