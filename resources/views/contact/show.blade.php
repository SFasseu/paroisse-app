<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Détails du Contact</h2>

    <p><strong>Nom :</strong> {{ $contact->name }}</p>
    <p><strong>Email :</strong> {{ $contact->email }}</p>
    <p><strong>Adresse :</strong> {{ $contact->address }}</p>
    <a href="{{ route('contact.index') }}"><button>Retour</button></a>
</body>

</html>