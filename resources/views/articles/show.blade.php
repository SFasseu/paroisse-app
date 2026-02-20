<h1>Détails de l'article</h1>

<p><strong>Nom :</strong> {{ $article->nom }}</p>
<p><strong>Quantité :</strong> {{ $article->quantite }}</p>
<p><strong>Prix :</strong> {{ $article->prix }}</p>
<p><strong>Description :</strong> {{ $article->description }}</p>

<a href="{{ route('articles.index') }}">Retour à la liste</a>
<a href="{{ route('articles.edit', $article->id) }}">Modifier</a>

<form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit">Supprimer</button>
</form>