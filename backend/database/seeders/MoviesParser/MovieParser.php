<?php

namespace Database\Seeders\MoviesParser;

use App\Models\Movies;
use Illuminate\Support\Facades\Log;

class MovieParser implements ParserContract {

    private $path = "../initdb/data.tsv";

    private $movies_type = [
        'short', 'movie', 'tvMovie', 'video',
        'tvEpisode', 'tvSeries', 'tvShort',
        'tvMiniSeries', 'tvSpecial', 'videoGame'
    ];

    public function run(){
        $handle = fopen($this->path, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {

                $lineArray = preg_split("/[\t]/", $line);

                $lineArray = $this->cleanDataLine($lineArray);

                if ($this->validate($lineArray) ){
                    $movie = new Movies;
                    $movie->tconst = $lineArray[0];
                    $movie->type = $lineArray[1];
                    $movie->primaryTitle = $lineArray[2];
                    $movie->originalTitle = $lineArray[3];
                    $movie->isAdult = $lineArray[4];
                    $movie->startYear = $lineArray[5];
                    $movie->endYear = $lineArray[6];
                    $movie->runtimeMinutes = $lineArray[7];
                    $movie->genres = $lineArray[8];
                    $movie->save();
                }
            }
            fclose($handle);
        } else {
            Log::error("Data.tsv is not readeable");
        }
    }

    private function cleanDataLine(array $lineArray) {
        foreach ($lineArray as &$elm){
            if ( $elm == '\N' ){
                // in database will be NULL
                $elm = NULL;
            }
        }

        return $lineArray;
    }

    public function validate(array $lineFile): bool{
        if (count($lineFile) !== 9 ){
            Log::error("Wrong split |{$lineFile}|");
            return false;
        }

        if (!in_array($lineFile[1], $this->movies_type)){
            Log::error("Wrong enum |{$lineFile[1]}|");
            return false;
        }

        if ($lineFile[4] !== '1' && $lineFile[4] !== '0'){
            Log::error("Wrong isAdult |$lineFile[4]|");
            return false;
        }

        if ( ! (strlen($lineFile[5]) === 4 || $lineFile[5] === NULL)){
            Log::error("Wrong StartDate |$lineFile[5]| ");
            return false;
        }

        return true;
    }
}
