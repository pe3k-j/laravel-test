<h1>Movies</h1>

<ul>
    @foreach ($movies as $movie)
    <li>
        {{ $movie->name }}
        <br>
        {{ $movie->movieType->slug }}
        @foreach ($movie->genres as $genre)
        {{ $genre->name }}
        @endforeach
    </li>
    @endforeach
</ul>
