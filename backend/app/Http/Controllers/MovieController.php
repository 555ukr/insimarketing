<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movies;

class MovieController extends Controller
{
    /**
     * Show the movie for a given id.
     *
     * @param  string  $id
     * @return 
     */
    public function show($id)
    {
        $movie = Movies::where('tconst', $id)->first();
        
        return response()->json($movie) ;
    }
}