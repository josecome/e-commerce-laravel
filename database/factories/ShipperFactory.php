<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipper>
 */
class ShipperFactory extends Factory
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
            'company_name' => $this->faker->text($maxNbChars = 26),
            'company_contact' => $this->faker->text($maxNbChars = 26),
            'company_email' => $this->faker->text($maxNbChars = 26),
            'user_id' => $user_ids[array_rand($user_ids)]
        ];
    }
}
