<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movies;
use Illuminate\Support\Facades\Validator;

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

    public function index(Request $request) {

        $validator = Validator::make($request->all(), [
            'title' => 'max:124',
            'type'  => 'in:short,movie,tvMovie,video,tvEpisode,tvSeries,tvShort,tvMiniSeries,tvSpecial,videoGame',
            'rating' => 'numeric',
            'page' => 'numeric',
            'order' => 'in:asc,desc'
            ]);

        if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

        $rating = $request->input('rating', 0);
        // 10 movies per page
        $skip =  $request->input('page', 0) * 10;
        $order = $request->input('order', 'asc');
        $type = $request->input('type', "short");

        $movies = new Movies();

        if ($request->has('title') && $request->input('title') !== ""){
            $result = $movies->getWihTitle(
                                $request->input('title'),
                                $rating,
                                $skip,
                                $order,
                                $type
            );
        } else {
            $result = $movies->getWithRatingTypeOnly($rating, $skip, $order, $type);
        }


        return [    "metadata" => [
                            'allRowsCounter' => $movies->allRowsCounter,
                        ],
                    "data" => $result->map(function ($item, $key){
                            $row = collect($item);
                            $row['rating'] = $row['rating']['averageRating'];
                            $row['isAdult'] = $row['isAdult'] ? 'yes' : 'no';
                            return $row;
                        })
                ];
    }
}
