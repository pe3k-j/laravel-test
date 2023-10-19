<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\VideogameController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index']);

Route::get('/info/aboutus', [AboutController::class, 'aboutUs'])->name('about-us');

// display /resources/views/terms.blade.php
Route::view('/terms',      'terms');
Route::redirect('/terms-and-conditions', '/terms');

// www.laravel.test/awards
Route::get('/awards', [AwardController::class, 'index']);

//          /movies
//          /movies/rating
//          /movies/anything
Route::get('/movies/{order?}', [MovieController::class, 'index'])->whereIn('order', ['rating']);

Route::get('/top-rated-movies', [MovieController::class, 'topRated']);
Route::get('/movies/genre/action', [MovieController::class, 'actionMovies']);

//          /person/anything
Route::get('/person/{person_id}', [PersonController::class, 'detail'])->whereNumber('person_id');

// OLD (ugly): /movie?id=111161
// NEW:     /movie/123
//          /movie/whatever
//          /movie/blablah
Route::get('/film/detail/{movie_id}', [MovieController::class, 'detail'])->whereNumber('movie_id')->name('movie.detail');


Route::get('/movies/genre', [MovieController::class, 'moviesOfGenre'])->name('movies.genre');
Route::get('/search', [MovieController::class, 'search'])->name('search');
Route::get('/movies/shawshank-redemption', [MovieController::class, 'shawshank']);
Route::get('/top-rated-games', [VideogameController::class, 'topRated']);
