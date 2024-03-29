<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $min = 200;
        $max = 400;
        $category_code = \App\Models\ProdCategory::pluck('category')->toArray();
        $product_code = \App\Models\Product::pluck('product')->toArray();
        $product_ids = \App\Models\Product::pluck('id')->toArray();
        $user_ids = \App\Models\User::pluck('id')->toArray();
        $customer_ids = \App\Models\Customer::pluck('id')->toArray();
        return [
            'product_id' => $product_ids[array_rand($product_ids)],
            'product' => $product_code[array_rand($product_code)],
            'qnty' => random_int(1, 4),
            'description' => $this->faker->text($maxNbChars = 26),
            'price' => mt_rand ($min*10, $max*10) / 10,
            'purchased' => random_int(0, 1),
            'category' => $category_code[array_rand($category_code)],
            'customer_id' => $customer_ids[array_rand($customer_ids)],
            'user_id' => $user_ids[array_rand($user_ids)]
        ];
    }
}
