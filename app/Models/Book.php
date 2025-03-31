<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Book extends Model
{
    use HasFactory;

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // add this we can use Book::title('title')->get();
    public function scopeTitle(Builder $query, string $title)
    {
        return $query->where('title', 'like', '%'.$title.'%');
    }

    public function scopePopular(Builder $query, $from = null, $to = null)
    {
        return $query->withCount([
            'reviews' => fn (Builder $q)=> $this->dateRangeFilter($q, $from, $to)
            // 'reviews' => function ($query) use ($from, $to) {
            //     if($from && !$to)
            //         $query->where('created_at', '>=', $from);
            //     elseif(!$from && $to)
            //         $query->where('created_at', '<=', $to);
            //     elseif($from && $to)
            //     $query->whereBetween('created_at', [$from, $to]);
            // }
        ])
            ->orderByDesc('reviews_count');
    }

    public function scopeHighestRated(Builder $query, $from = null, $to = null)
    {
        return $query->withAvg([
            'reviews' =>
                fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)
            ],
            'rating'
            )
            ->orderByDesc('reviews_avg_rating');
    }
    public function scopeMinReviews(Builder $query, int $minCount)
    {
        return $query->withCount('reviews')
            ->having('reviews_count', '>=', $minCount);
    }
    public function scopeWithRecentReviews(Builder $query, Closure $interval)
    {
        return $query->with(['reviews' => fn (Builder $q)=> $this->dateRangeFilter($q, $from, $to)]);
    }


    public function scopePopularLastMonth(Builder $query)
    {
        return $query->popular(now()->subMonth(), now())
            ->highestRated(now()->subMonth(), now())
            ->minReviews(5);
    }

    public function scopePopularLast6Months(Builder $query)
    {
        return $query->popular(now()->subMonth(6), now())
        ->highestRated(now()->subMonth(6), now())
        ->minReviews(2);
    }

    public function scopeHighestRatedLastMonth(Builder $query)
    {
        return $query->highestRated(now()->subMonth(), now())
        ->popular(now()->subMonth(), now())
        ->minReviews(1);
    }
    public function scopeHighestRatedLast6Month(Builder $query)
    {
        return $query->highestRated(now()->subMonth(6), now())
        ->popular(now()->subMonth(6), now())
        ->minReviews(1);
    }

    private function dateRangeFilter(Builder $query, $from, $to)
    {
        if($from && !$to)
            $query->where('created_at', '>=', $from);
        elseif(!$from && $to)
            $query->where('created_at', '<=', $to);
        elseif($from && $to)
            $query->whereBetween('created_at', [$from, $to]);
    }
}
