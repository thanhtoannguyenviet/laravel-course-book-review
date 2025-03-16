<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name,
            'created_at' => $this->faker->dateTimeBetween('-3 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-3 year', 'now'),
        ];
    }
    public function good()
    {
        return [
            'rating' => fake()->numberBetween(4, 5),
        ];
    }
    public function average()
    {
        return [
            'rating' => fake()->numberBetween(2, 5),
        ];
    }
    public function bad()
    {
        return [
            'rating' => fake()->numberBetween(2, 5),
        ];
    }
}
