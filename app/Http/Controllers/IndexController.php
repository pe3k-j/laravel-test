<?php

namespace App\Http\Controllers;


class IndexController extends Controller
{
    //
    public function index()
    {
        $view = view('index.index');

        return $view;
    }
}
