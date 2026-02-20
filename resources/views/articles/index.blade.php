<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>article</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <a href="{{ route('articles.create') }}" class="btn btn-primary">Ajouter</a>

<table border="1">
    <tr>
        <th>Nom</th>
        <th>Quantité</th>
        <th>Prix</th>
        <th>Action</th>
    </tr>

@foreach($articles as $article)
<tr>
    <td>{{ $article->nom }}</td>
    <td>{{ $article->quantite }}</td>
    <td>{{ $article->prix }}</td>

    <td>
        <a href="{{ route('articles.edit',$article->id) }}">Edit</a>

        <form action="{{ route('articles.destroy',$article->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>

{{ $articles->links() }}
</body>
</html>