<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact</title>
</head>
<body>
   <div class="container">
    <div class="row mt-5">
        <a href="'contacts.create" class="btn btn-primary mb-3">Ajouter un contact</a>
        <h1>Ajouter un contact</h1>
<form action="contacts.store" method="GET">
    @csrf
    Nom: <input type="text" name="nom"><br>
    Email: <input type="email" name="email"><br>
    Adresse: <input type="text" name="adresse"><br>
    <button>Enregistrer</button>
</form>
</div>
</div>

<ul>
    <br>
    <table border="2" width="100%">
    <h1>Liste des Contacts</h1>

                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->nom }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->address }}</td>
                    <td> 
        
        <a href="{{ route('contacts.edit', $contact->id) }}" style="text-decoration: none;"><button style="width: 50%";>Editer</button></a>
        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline; gap: 10px;">
            @csrf
            @method('DELETE')
            <button style="width:35%";>Supprimer</button>
        </form>
    </li>
</td>
                </tr>
                <tr>
                   
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>



</ul>
