<h2>Modifier le contact</h2>

<form action="{{ route('contact.update', $contact->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Name :</label>
    <input type="text" name="name" value="{{ $contact->name }}"><br><br>

    <label>Email :</label>
    <input type="email" name="email" value="{{ $contact->email }}"><br><br>

    <label>Adresse :</label>
    <input type="text" name="adresse" value="{{ $contact->adresse }}"><br><br>

    <button type="submit">Modifier</button>
</form>

<a href="{{ route('contact.index') }}">Retour</a>
