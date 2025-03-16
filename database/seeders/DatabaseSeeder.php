<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Review;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Book::factory(20)->create()->each(function ($book) {
            $numReviews = random_int(5, 20);
            Review::factory($numReviews)->count($numReviews)
                ->good()
                ->for($book)
                ->create();
        });
        Book::factory(30)->create()->each(function ($book) {
            $numReviews = random_int(5, 20);
            Review::factory($numReviews)->count($numReviews)
                ->average()
                ->for($book)
                ->create();
        });
        Book::factory(10)->create()->each(function ($book) {
            $numReviews = random_int(5, 20);
            Review::factory($numReviews)->count($numReviews)
                ->bad()
                ->for($book)
                ->create();
        });
    }
}
