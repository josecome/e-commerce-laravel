<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category' => str_replace(' ', '', $this->faker->unique()->text($maxNbChars = 16)),
            'description' => $this->faker->text($maxNbChars = 26),
            'user_id' => random_int(1, 6)
        ];
    }
}
