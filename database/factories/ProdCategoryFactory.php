<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProdCategory>
 */
class ProdCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category' => Str::random(10), //str_replace(' ', '', $this->faker->unique()->text($maxNbChars = 16)),
            'description' => $this->faker->text($maxNbChars = 26),
            'image_link' => $this->faker->text($maxNbChars = 20),
            'user_id' => random_int(1, 6)
        ];
    }
}
