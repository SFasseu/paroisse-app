<!-- Titre affiché en haut de la page -->
<h2>Modifier le contact</h2>

<!-- Formulaire pour mettre à jour un contact existant -->
<form action="{{ route('contact.update', $contact->id) }}" method="POST">
    <!-- Jeton CSRF obligatoire en Laravel pour sécuriser les formulaires -->
    @csrf
    <!-- Indique à Laravel que la requête doit être traitée comme une mise à jour (PUT) -->
    @method('PUT')

    <!-- Champ texte pour modifier le nom du contact -->
    <label>Name :</label>
    <input type="text" name="name" value="{{ $contact->name }}"><br><br>

    <!-- Champ email pour modifier l'adresse email du contact -->
    <label>Email :</label>
    <input type="email" name="email" value="{{ $contact->email }}"><br><br>

    <!-- Champ texte pour modifier l'adresse physique du contact -->
    <label>Adresse :</label>
    <input type="text" name="adresse" value="{{ $contact->adresse }}"><br><br>

    <button type="submit">Modifier</button>
</form>

<!-- Lien pour revenir à la liste complète des contacts -->
<a href="{{ route('contact.index') }}">Retour</a>
