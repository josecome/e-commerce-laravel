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
        return [
            'company_name' => $this->faker->text($maxNbChars = 26),
            'company_contact' => $this->faker->text($maxNbChars = 26),
            'company_email' => $this->faker->text($maxNbChars = 26),
            'user_id' => random_int(1, 6)
        ];
    }
}
