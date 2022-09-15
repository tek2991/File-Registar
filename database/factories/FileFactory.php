<?php

namespace Database\Factories;

use App\Models\Office;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Get a random office 
        $office = Office::inRandomOrder()->first();
        return [
            'name' => $this->faker->unique()->name,
            'parent_office_id' => $office->id,
            'current_office_id' => $office->id,
        ];
    }
}
