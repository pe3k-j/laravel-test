<?php

namespace App\Http\Controllers;

use App\Models\Movie;

class IndexController extends Controller
{
    //
    public function index()
    {

        $movies = Movie::query()
            ->where('votes_nr', '>=', 5000)
            ->where('movie_type_id', 1)
            ->orderBy('rating', 'desc')
            ->limit(10)
            ->pluck('name');

        $view = view('index.index', ['movies' => $movies]);

        return $view;
    }
}
