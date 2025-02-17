<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Movies</title>
</head>

<body>
    <h1>Watchlist movies</h1>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Platform</th>
                <th scope="col">Released?</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($movies))
                @foreach ($movies as $movie)
                    <tr scope="row">
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
