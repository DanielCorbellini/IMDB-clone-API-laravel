<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Movies</title>
</head>

<body>
    <h1>Watchlist movies</h1>

    <div id="message"></div>
    <form id="watchlist-form">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>
        <div class="form-group">
            <label for="storyline">Storyline</label>
            <input type="text" class="form-control" name="storyline" id="storyline" required>
        </div>
        <div class="form-group">
            <label for="platform_id">Platform</label>
            <select class="form-control" name="platform_id" id="platform_id" required>
                <option value="" disabled>Select a platform</option>
                @foreach ($streamPlatforms as $streamPlatform)
                    <option value="{{ $streamPlatform['id'] }}">{{ $streamPlatform['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="released">Released</label>
            <select class="form-control" name="released" id="released" required>
                <option value="true">Yes</option>
                <option value="false">No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Code</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Platform</th>
                <th scope="col">Released?</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($movies))
                @foreach ($movies as $movie)
                    <tr scope="row" id="{{ $movie['id'] }}">
                        <td> {{ $movie['id'] }} </td>
                        <td> {{ $movie['title'] }} </td>
                        <td> {{ $movie['storyline'] }} </td>
                        <td> {{ $movie->platform->name ?? 'Desconhecido' }} </td>
                        <td> {{ $movie['released'] ? 'Yes' : 'No' }} </td>
                        <td> <button type="submit" class="btn btn-danger delete-movie"
                                data-id="{{ $movie['id'] }}">Remover</button> </td>
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
<script>
    // adicionar
    document.getElementById('watchlist-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Evita recarregar a página

        const title = document.getElementById('title').value;
        const storyline = document.getElementById('storyline').value;
        const platform_id = document.getElementById('platform_id').value;
        const released = document.getElementById('released').value === "true" ? "Yes" : "No";

        const data = {
            title,
            storyline,
            platform_id,
            released: released === "Yes"
        };

        fetch('http://127.0.0.1:8000/api/watchlist/create', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    document.getElementById('message').innerHTML =
                        `<div class="alert alert-danger">${data.error}</div>`;
                } else {
                    document.getElementById('message').innerHTML =
                        `<div class="alert alert-success">Item adicionado com sucesso!</div>`;
                    document.getElementById('watchlist-form').reset(); // Limpa o formulário

                    // ✅ Adiciona o novo filme à tabela dinamicamente
                    const newRow = document.createElement('tr');
                    newRow.id = `${data.id}`; // Correção aqui
                    newRow.innerHTML = `
                    <td>${title}</td>
                    <td>${storyline}</td>
                    <td>${platform_id}</td>
                    <td>${released}</td>
                    <td> <button type="submit" class="btn btn-danger delete-movie"
                                data-id="${data.id}">Remover</button> </td>`;
                    document.querySelector("tbody").appendChild(newRow);
                }
            })
            .catch(error => {
                console.error('Erro ao enviar dados:', error);
            });
    });

    // Seleciona todos os botões de remover
    document.querySelector("tbody").addEventListener("click", function(event) {
        if (event.target.classList.contains("delete-movie")) {
            const movieId = event.target.getAttribute("data-id");

            fetch(`http://127.0.0.1:8000/api/watchlist/delete/${movieId}`, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Erro ao deletar o filme");
                    }
                    return response.json();
                })
                .then(data => {
                    const movieElement = document.getElementById(movieId);
                    if (movieElement) {
                        movieElement.remove();
                    } else {
                        console.warn(`Elemento com ID ${movieId} não encontrado.`);
                    }
                })
                .catch(error => console.error("Erro:", error));
        }
    });
</script>

</html>
