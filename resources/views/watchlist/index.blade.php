<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies</title>
</head>

<body>
    <h1>Watchlist movies</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Platform</th>
                <th>Released?</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($movies))
                @foreach ($movies as $movie)
                    <tr>
                        <td> {{ $movie['title'] }} </td>
                        <td> {{ $movie['storyline'] }} </td>
                        <td> {{ $movie['platform_id'] }} </td>
                        <td> {{ $movie['released'] ? 'Yes' : 'No' }} </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">No movies found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>

</html>
