<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\MoviesParser\MoviesParser;
use Database\Seeders\MoviesParser\MoviesRatingParser;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    private $failCount; 

    public function run()
    {
        $movie = new MoviesParser();
        $movie->run();

        $movieRating = new MoviesRatingParser();
        $movieRating->run();
    }

}
