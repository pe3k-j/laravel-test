<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function index($order = null)
    {
        $query = Movie::query(); // FROM `movies`

        if ($order === 'rating') {
            $query->orderBy('rating', 'desc'); // ORDER BY `rating` DESC
        } else {
            $query->orderBy('name');         // ORDER BY `name` ASC
        }

        $movies = $query
            ->where('votes_nr', '>=', 10000) // WHERE `votes_nr` >= 10000
            ->limit(20)                      // LIMIT 20
            ->get();                         // SELECT

        return view('movies.index', compact('movies'));
    }

    public function topRated()
    {
        // $query = "
        //     SELECT *
        //     FROM `movies`
        //     WHERE `votes_nr` >= ?
        //         AND `movie_type_id` = ?
        //     ORDER BY `rating` DESC
        //     LIMIT 50
        // ";

        // $movies = DB::select($query, [5000, 1]);

        $movies = Movie::where('votes_nr', '>=', 5000)
            ->where('movie_type_id', 1)
            ->orderBy('rating', 'desc')
            ->limit(50)
            ->get();

        return view('movies.top-rated', compact('movies'));
    }

    public function actionMovies()
    {
        // $genre = DB::selectOne("
        //     SELECT *
        //     FROM `genres`
        //     WHERE `id` = ?
        // ", [
        //     31
        // ]);

        // $movies = DB::select("
        //     SELECT *
        //     FROM `genre_movie`
        //     LEFT JOIN `movies`
        //         ON `genre_movie`.`movie_id` = `movies`.`id`
        //     WHERE `genre_movie`.`genre_id` = ?
        //     LIMIT 10
        // ", [
        //     31
        // ]);

        $genre = Genre::find(31);

        // $movies = $genre->movies;
        $movies = $genre->movies()
            ->limit(10)
            ->orderBy('year', 'desc')
            ->get();

        return view('movies.genre', compact(
            'genre',
            'movies'
        ));
    }

    public function moviesOfGenre()
    {
        $slug = $_GET['genre'] ?? null;

        if (!$slug) {
            abort(404);
        }

        // $genre = DB::selectOne("
        //     SELECT *
        //     FROM `genres`
        //     WHERE `slug` = ?
        // ", [
        //     $slug
        // ]);

        // if (!$genre) {
        //     abort(404);
        // }

        // replaces commented-out code above:
        $genre = Genre::where('slug', $slug)->firstOrFail();

        // $movies = DB::select("
        //     SELECT *
        //     FROM `genre_movie`
        //     LEFT JOIN `movies`
        //         ON `genre_movie`.`movie_id` = `movies`.`id`
        //     WHERE `genre_movie`.`genre_id` = ?
        //     LIMIT 10
        // ", [
        //     $genre->id
        // ]);

        // replaces commented-out code above:
        $movies = $genre->movies()
            ->limit(10)
            ->get();

        return view('movies.genre', compact(
            'genre',
            'movies'
        ));
    }

    public function detail($movie_id)
    {
        // $movie_id = $_GET['id'] ?? null;

        // if (!$movie_id) {
        //     abort(404);
        // }

        // $movie = DB::selectOne('
        //     SELECT *
        //     FROM `movies`
        //     WHERE `id` = ?
        // ', [
        //     $movie_id
        // ]);

        // if (!$movie) {
        //     abort(404);
        // }

        // replaces commented-out code above:
        $movie = Movie::findOrFail($movie_id);

        // $all_people = DB::select("
        //     SELECT `positions`.`name` AS position_name, `people`.*
        //     FROM `movie_person`
        //     LEFT JOIN `positions`
        //         ON `movie_person`.`position_id` = `positions`.`id`
        //     LEFT JOIN `people`
        //         ON `movie_person`.`person_id` = `people`.`id`
        //     WHERE `movie_person`.`movie_id` = ?
        // ", [
        //     $movie->id
        // ]);

        // replaces commented-out code above:
        $all_people = Person::query()
            ->select('positions.name AS position_name', 'people.*')
            ->rightJoin('movie_person', 'people.id', 'movie_person.person_id')
            ->leftJoin('positions', 'movie_person.position_id', 'positions.id')
            ->where('movie_person.movie_id', $movie->id)
            ->get();

        $people_sorted_by_position = [];
        foreach ($all_people as $person) {
            $people_sorted_by_position[$person->position_name][] = $person;
        }

        return view('movies.detail', [
            'movie' => $movie,
            'people' => $people_sorted_by_position
        ]);
    }

    public function shawshank()
    {
        // $movie = DB::selectOne('
        //     SELECT *
        //     FROM `movies`
        //     WHERE `id` = ?
        // ', [
        //     111161
        // ]);

        // if (!$movie) {
        //     abort(404);
        // }

        // replaces commented-out code above:
        $movie = Movie::findOrFail(111161);

        // $all_people = DB::select("
        //     SELECT `positions`.`name` AS position_name, `people`.*
        //     FROM `movie_person`
        //     LEFT JOIN `positions`
        //         ON `movie_person`.`position_id` = `positions`.`id`
        //     LEFT JOIN `people`
        //         ON `movie_person`.`person_id` = `people`.`id`
        //     WHERE `movie_person`.`movie_id` = ?
        // ", [
        //     $movie->id
        // ]);

        // replaces commented-out code above:
        $all_people = Person::query()
            ->select('positions.name AS position_name', 'people.*')
            ->rightJoin('movie_person', 'people.id', 'movie_person.person_id')
            ->leftJoin('positions', 'movie_person.position_id', 'positions.id')
            ->where('movie_person.movie_id', $movie->id)
            ->get();

        $people_sorted_by_position = [];
        foreach ($all_people as $person) {
            $people_sorted_by_position[$person->position_name][] = $person;
        }

        return view('movies.detail', [
            'movie' => $movie,
            'people' => $people_sorted_by_position
        ]);
    }

    public function search()
    {
        $search_term = $_GET['search'] ?? null;

        if ($search_term) {
            // $results = DB::select("
            //     SELECT *
            //     FROM `movies`
            //     WHERE `name` LIKE ?
            //     ORDER BY `name` ASC
            // ", [
            //     '%' . $search_term . '%'
            // ]);

            // replaces commented-out code above:
            $results = Movie::query()
                ->where('name', 'like', '%' . $search_term . '%')
                ->orderBy('name', 'asc')
                ->get();
        }

        return view('movies.search', [
            'search_term' => $search_term,
            'results' => $results ?? []
        ]);
    }
}
