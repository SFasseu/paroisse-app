<h1>Ajouter un article</h1>

<form action="{{ route('articles.store') }}" method="POST">
    @csrf
    <label>Nom :</label>
    <input type="text" name="nom" required>
    <br>
    <label>Quantité :</label>
    <input type="number" name="quantite" required>
    <br>
    <label>Prix :</label>
    <input type="number" step="0.01" name="prix" required>
    <br>
    <label>Description :</label>
    <textarea name="description"></textarea>
    <br>
    <button type="submit">Ajouter</button>
</form>