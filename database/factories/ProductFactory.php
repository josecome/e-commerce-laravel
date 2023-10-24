<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
        return [
            'product' => str_replace(' ', '', $this->faker->unique()->text($maxNbChars = 16)),
            'description' => $this->faker->text($maxNbChars = 26),
            'price' => mt_rand ($min*10, $max*10) / 10,
            'category' => $category_code[array_rand($category_code)],
            'image_link' => $this->faker->text($maxNbChars = 20),
            'user_id' => random_int(1, 6)
        ];
    }
}
