<?php

namespace App\Http\Controllers;

use App\Models\Movie;

class MovieController extends Controller
{
    //
    public function index()
    {

        $movies = Movie::query()
            ->orderBy('name')
            ->limit(200)
            ->get();


        $view = view('movies.index', ['movies' => $movies]);

        return $view;
    }
}
