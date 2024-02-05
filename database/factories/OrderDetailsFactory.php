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
        $prices = \App\Models\Cart::pluck('price')->toArray();
        return [
            'product_id' => random_int(1, 6),
            'customer_id' => random_int(1, 6),
            'qnty' => random_int(1, 6),
            'price' => $prices[array_rand($prices)],
            'user_id' => random_int(1, 6)
        ];
    }
}
