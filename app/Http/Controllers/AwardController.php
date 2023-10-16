<?php

namespace App\Http\Controllers;

class AwardController extends Controller
{
    //
    public function index()
    {
        $awards = [
            'Oscars',
            'Golden Globes',
            'Bafta',
            'Emmy'
        ];

        $view = view('awards.index', ['awards' => $awards]);

        return $view;
    }
}
