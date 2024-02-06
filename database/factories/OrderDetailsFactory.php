<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetails>
 */
class OrderDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product_ids = \App\Models\Product::pluck('id')->toArray();
        $payment_ids = \App\Models\Payment::pluck('id')->toArray();
        $prices = \App\Models\Cart::pluck('price')->toArray();
        $user_ids = \App\Models\User::pluck('id')->toArray();
        return [
            'product_id' => $product_ids[array_rand($product_ids)],
            'customer_id' => random_int(1, 6),
            'payment_id' => $payment_ids[array_rand($payment_ids)],
            'qnty' => random_int(1, 6),
            'price' => $prices[array_rand($prices)],
            'user_id' => $user_ids[array_rand($user_ids)]
        ];
    }
}
