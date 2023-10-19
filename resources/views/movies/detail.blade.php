<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $movie->name }}</title>
</head>
<body>

    <h1>{{ $movie->name }}</h1>

    <div class="year">
        {{ $movie->year }}
    </div>


    @if ($movie->rating > 8)
        <h2>Top rated movie</h2>
    @endif



    <h2>Cast & crew</h2>

    @foreach ($people as $position_name => $position_people)

        <h3>{{ $position_name }}</h3>

        <ul>
            @foreach ($position_people as $person)
                <li>
                    {{ $person->fullname }}
                </li>
            @endforeach
        </ul>

    @endforeach

</body>
</html>