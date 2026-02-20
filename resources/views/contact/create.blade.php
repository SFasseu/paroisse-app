


<h2>Ajouter un contact</h2>

<form action="{{ route('contact.store') }}" method="POST">
    @csrf

    <label>Name :</label>
    <input type="text" name="name"><br><br>

    <label>Email :</label>
    <input type="email" name="email"><br><br>

    <label>Adresse :</label>
    <input type="text" name="adresse"><br><br>

    <label>Phone :</label>
    <input type="text" name="phone"><br><br>

    <button type="submit">Enregistrer</button>
</form>

<a href="{{ route('contact.index') }}">Retour</a>
