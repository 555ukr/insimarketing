<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;

    public $allRowsCounter;

    public function rating(){
        return $this->hasOne(MovieRatings::class, 'tconst', 'tconst');
    }

    public function getWihTitle($title, $rating, $skip, $order, $type){
        $rows = $this->with('rating')
                    ->where('primaryTitle', 'like', $title . '%')
                    ->whereHas('rating', function($q) use ($rating, $order){
                        $q->where('averageRating', '>', $rating)
                        ->orderBy('averageRating', $order);
                    })
                    ->where('type', $type)
                    ->skip($skip)
                    ->take(10)
                    ->get();

        $count = $this->with('rating')
                        ->where('primaryTitle', 'like', $title . '%')
                        ->whereHas('rating', function($q) use ($rating, $order){
                            $q->where('averageRating', '>', $rating);
                        })
                        ->where('type', $type)
                        ->count();
        $this->allRowsCounter = $count;
        return $rows;
    }

    public function getWithRatingTypeOnly($rating, $skip, $order, $type){
        $rows =$this->with('rating')
                    ->whereHas('rating', function($q) use ($rating, $order){
                        $q->where('averageRating', '>', $rating)
                        ->orderBy('averageRating', $order);
                    })
                    ->where('type', $type)
                    ->skip($skip)
                    ->take(10)
                    ->get();
        
        $count = $this->with('rating')
                        ->whereHas('rating', function($q) use ($rating, $order){
                            $q->where('averageRating', '>', $rating);
                        })
                        ->where('type', $type)
                        ->count();
        $this->allRowsCounter = $count;          
        return $rows;
    }
}
