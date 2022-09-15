<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Office>
 */
class OfficeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // Initials must be random 5 capital alphabets
            'initials' => $this->faker->unique()->regexify('[A-Z]{5}'),
            'name' => $this->faker->unique()->company,
        ];
    }
}
