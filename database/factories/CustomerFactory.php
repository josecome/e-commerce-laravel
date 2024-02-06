<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
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
            'first_name' => $this->faker->text($maxNbChars = 26),
            'last_name' => $this->faker->text($maxNbChars = 26),
            'city' => $this->faker->text($maxNbChars = 26),
            'state' => $this->faker->text($maxNbChars = 26),
            'country' => $this->faker->text($maxNbChars = 26),
            'user_id' => $user_ids[array_rand($user_ids)]
        ];
    }
}
