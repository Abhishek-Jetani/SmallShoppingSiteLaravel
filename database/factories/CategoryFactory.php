<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence($nbWords = 1, $variableNbWords = true);
        $title = substr($title, 0, 8); 

        return [
            'title' => $title,
            'image' => $this->faker->imageUrl($width = 640, $height = 480), 
            'description' => $this->faker->sentence(),
            'status' => $this->faker->randomElement([1]),
            'created_at' => now(),
            'updated_at' => now(),
        ];


    }
}
