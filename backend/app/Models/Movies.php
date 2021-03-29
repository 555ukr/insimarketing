<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;

    public function rating(){
        return $this->hasOne(MovieRatings::class, 'tconst', 'tconst');
    }

    public function getWihTitle($title, $rating, $skip, $order){
        return $this->with('rating')
                ->where('primaryTitle', 'like', $title . '%')
                ->whereHas('rating', function($q) use ($rating, $order){
                    $q->where('averageRating', '>', $rating)
                    ->orderBy('averageRating', $order);
                })
                ->skip($skip)
                ->take(10)
                ->get();
    }
    public function getWithRatingOnly($rating, $skip, $order){
        return $this->with('rating')
                    ->whereHas('rating', function($q) use ($rating, $order){
                        $q->where('averageRating', '>', $rating)
                           ->orderBy('averageRating', $order);
                    })
                    ->skip($skip)
                    ->take(10)
                    ->get();
    }
}
