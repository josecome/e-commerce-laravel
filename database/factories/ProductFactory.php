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
        $category_code = \App\Models\ProdCategories::pluck('code')->toArray();
        return [
            'product' => str_replace(' ', '', $this->faker->unique()->text($maxNbChars = 16)),
            'description' => $this->faker->text($maxNbChars = 26),
            'district' => $category_code[array_rand($category_code)],
            'user_id' => random_int(1, 6)
        ];
    }
}
