<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AwardController extends Controller
{
    public function index()
    {
        $greeting = 'world';

        $awards = [
            'Oscars',
            'Golden Globes',
            'Bafta',
            'Emmy'
        ];

        $name = 'Jan';

        // /resouces/views/awards/index.blade.php
        //                 awards.index
        return view('awards.index', compact(
            'greeting',
            'name',
            'awards'
        ));


        // equivalent 2nd argument:
        // [
        //     'greeting'  => $greeting,
        //     'name'      => $name,
        //     'awards'    => $awards
        // ]
    }
}
