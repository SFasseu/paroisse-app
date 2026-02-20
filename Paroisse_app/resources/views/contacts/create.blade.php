<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create</title>
</head>
<body>
    <h1>Ajouter un contact</h1>
<form action="'contacts.store" method="GET">
    @csrf
    Nom: <input type="text" name="nom"><br>
    Email: <input type="email" name="email"><br>
    Téléphone: <input type="text" name="telephone"><br>


    <button>Enregistrer</button>
</form>

</body>
</html>
