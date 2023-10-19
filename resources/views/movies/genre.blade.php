<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Action movies</title>
</head>
<body>

    <h1>Movies of genre "<?= $genre->name ?>"</h1>

    <ul>
        <?php foreach ($movies as $movie) : ?>
            <li>
                <?= $movie->name ?>
                (<?= $movie->year ?>)
            </li>
        <?php endforeach; ?>
    </ul>

</body>
</html>