<?php

namespace App\Http\Controllers;


class AboutController extends Controller
{
    //
    public function aboutUs()
    {
        $authors = [
            'francis' => [
                'name' => 'Francis Myers',
                'age' => 37,
                'position' => 'CEO'
            ],
            'ines' => [
                'name' => 'Ines Wyatt',
                'age' => 25,
                'position' => 'CFO'
            ],
            'tom' => [
                'name' => 'Tom Whitehead',
                'age' => 29,
                'position' => 'Lead Accountant'
            ],
            'layla' => [
                'name' => 'Layla-Rose Foster',
                'age' => 28,
                'position' => 'Team leader'
            ]
        ];
        $view = view('about-us', ['authors' => $authors]);

        return $view;
    }
}
