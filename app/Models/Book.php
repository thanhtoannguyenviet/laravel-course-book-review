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
}
