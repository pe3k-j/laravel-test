<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie website</title>
</head>
<body>
{{-- /resources/views/components/topmenu.blade.php --}}
{{--                  components.topmenu           --}}
    @include('components.topmenu', [
        'active_item' => 'home'
    ])

    <h1>Movie website</h1>

    <p>Welcome to the movie website</p>

    <a href="/awards">Awards</a>

    {{-- TODO: this needs to be updated, it is unsafe --}}

    <ul>
        @foreach ($movies as $movie)
            <li>
                {{-- <a href="/movie/{{ $movie->id }}"> --}}
                {{-- <a href="{{ action([App\Http\Controllers\MovieController::class, 'detail'], $movie->id) }}"> --}}
                <a href="{{ route('movie.detail', $movie->id) }}">
                    {{ $movie->name }}
                </a>
            </li>
        @endforeach
    </ul>

    <h2>Search for a movie:</h2>

    <form action="/search" method="get">
        <input type="text" name="search">
        <button>Search</button>
    </form>

</body>
</html>