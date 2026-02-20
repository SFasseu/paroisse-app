<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
</head>
<body>
    <h2>Modification Du Contact.</h2>
    <form action="{{ route('contact.edit',  $contact->id ) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $contact->name }}"><br>
        <input type="text" name="email" value="{{ $contact->email }}"><br>
        <input type="text" name="address" value="{{ $contact->address }}"><br>
       <button type="submit">Edit</button><br>
        <a href="{{ route('contact.index') }}"><button>Retour</button></a>
    </form>
</body>
</html>