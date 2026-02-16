<h2>Ajouter un contact</h2>

<form action="{{ route('contact.store') }}"method="POST">
    <label for="name">Nom :</label>
    <input type="text" name="name"><br><br>
    <label for="email">Email :</label>
    <input type="email" name="email"><br><br>
    <label for="address">Adresse :</label>
    <input type="text" name="address"><br><br>

    <button type="submit">Enregistrer</button>
</form>
<br>
<a href="{{ route('contacts.index') }}">Retour</a>