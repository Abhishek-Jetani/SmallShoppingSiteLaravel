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
    public function definition(): array
    {
        $title = $this->faker->sentence($nbWords = 1, $variableNbWords = true);
        $title = substr($title, 0, 8); 

        return [
            'title' => $title,
            'category_id' => $this->faker->numberBetween(1, 4),
            'short_desc' => $this->faker->sentence(),
            'full_desc' => $this->faker->sentence(),
            'status' => $this->faker->randomElement([1]),
            'price' => $this->faker->numberBetween(10, 1000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
 