<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        // $results = Movie::query()         // FROM `movies`
        //     ->where('id', 111161)         // WHERE `id` = 111161
        //     ->limit(10)                   // LIMIT 10
        //     ->orderBy('name', 'asc')      // ORDER BY `name` ASC
        //     ->where('year', 1994)         //    AND `year` = 1994
        //     ->first();                      // SELECT *

        // dd($results);


        // Movie::where('id', 111161); // FROM `movies` WHERE `id` = 111161

        // Movie::query(); // FROM `movies`

        $movies = Movie::query()            // FROM `movies`
            ->where('votes_nr', '>=', 5000) // WHERE `votes_nr` >= 5000
            ->where('movie_type_id', 1)     //   AND `movie_type_id` = ?
            ->orderBy('rating', 'desc')     // ORDER BY `rating` DESC
            ->limit(10)                     // LIMIT 10
            ->get();                        // SELECT *
            // ->pluck('rating', 'name');


        // $shawshank = Movie::find(111161);

        // $some_movie = Movie::findOrFail(111162);

        // $movie_type = MovieType::where('slug', 'mini_series')->first();
        // dd($movie_type->movies);

        // $movies = DB::select("
        //     SELECT *
        //     FROM `movies`
        //     WHERE `votes_nr` >= ?
        //         AND `movie_type_id` = ?
        //     ORDER BY `rating` DESC
        //     LIMIT 10;
        // ", [
        //     5000,
        //     1
        // ]);

        // /resources/views/index/index.blade.php
        //                  index.index
        return view('index.index', [
            'movies' => $movies
        ]);
    }
}
