<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edit</title>
</head>
<body>
    <h1>Modifier contact</h1>
<form action="{{ route('contacts.update', $contact->id) }}" method="POST">
    @csrf
    @method('PUT')
    Nom: <input type="text" name="nom" value="{{ $contact->nom }}"><br>
    Email: <input type="email" name="email" value="{{ $contact->email }}"><br>
    Téléphone: <input type="text" name="telephone" value="{{ $contact->telephone }}"><br>
    <button>Modifier</button>
</form>

</body>
</html>