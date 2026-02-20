<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Contact</title>
</head>
<body>
    <div class="container">
        <div class="row mt-5">

        </div>
         <!-- Bouton pour accéder au formulaire de création d’un nouveau contact -->
         <a href="/contact"></a>
        <button>Ajouter un contact</button>
    </a>

    <table border="2">
        <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Action</th>
        </thead>
        <tbody>
            <!-- Boucle Laravel pour parcourir tous les contacts -->
            @foreach ($contacts as $contact)
                <tr>
                    <!-- Affichage des informations du contact -->
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->adresse }}</td>
                    <td>
                        <a href="{{ route('contact.edit', $contact->id) }}">Modifier</a>

                        <!-- Formulaire pour supprimer le contact -->
                        <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" style="display:inline;">
                            <!-- Jeton CSRF pour sécuriser la requête -->
                            @csrf
                            <!-- Méthode DELETE pour indiquer une suppression -->
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>

                        <!-- Lien pour voir les détails du contact -->
                        <a href="{{ route('contact.show', $contact->id) }}">Voir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
   
</body>


</html>