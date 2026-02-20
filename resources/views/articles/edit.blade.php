<h1>Modifier un article</h1>

<form action="{{ route('articles.update', $article->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Nom :</label>
    <input type="text" name="nom" value="{{ $article->nom }}" required>
    <br>
    <label>Quantité :</label>
    <input type="number" name="quantite" value="{{ $article->quantite }}" required>
    <br>
    <label>Prix :</label>
    <input type="number" step="0.01" name="prix" value="{{ $article->prix }}" required>
    <br>
    <label>Description :</label>
    <textarea name="description">{{ $article->description }}</textarea>
    <br>
    <button type="submit">Modifier</button>
</form>