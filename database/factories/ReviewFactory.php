<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_id' => null,
            'rating' => $this->faker->numberBetween(1, 5),
            'review' => $this->faker->paragraph,
            'created_at' => $this->faker->dateTimeBetween('-3 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-3 year', 'now'),
        ];
    }
}
