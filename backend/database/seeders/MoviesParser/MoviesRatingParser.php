<?php

namespace Database\Seeders\MoviesParser;

use Illuminate\Support\Facades\Log;
use App\Models\MovieRatings;

class MoviesRatingParser implements ParserContract {

    public function run(){
        $handle = fopen("../initdb/data-ratings.tsv", "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                
                $lineArray = preg_split("/[\t]/", $line);
                if ($this->validate($lineArray) ){
                    $moviesRating = new MovieRatings;
                    $moviesRating->tconst = $lineArray[0];
                    $moviesRating->averageRating = $lineArray[1];
                    $moviesRating->numVotes =  $lineArray[2];
                    $moviesRating->save();
                }
            }
            fclose($handle);
        } else {
            Log::error("Data-ratings.tsv is not readeable");
        } 
    }

    public function validate(array $lineFile): bool{
        if (count($lineFile) !== 3 ){
            Log::error("Wrong split |{$lineFile}|");
            return false;
        }

        if ( strlen($lineFile[1]) !== 3 ){
            Log::error("Wrong Rating |$lineFile[1]|");
            return false;
        }

        return true;
    }

}