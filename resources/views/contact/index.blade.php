<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
</head>
<body>
   <h2>Liste des contacts</h2>
   <a href="{{ route('contact.create') }}">+ Ajouter un contact</a>
   @if(session('success'))
   <p style="color:green">session('success')</p>
   @endif

<table border="2" width="100%" align="center">
    <thead>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>address</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($contacts as $contact )
         <tr>
            <td>{{ $contact->id }}</td>
            <td>{{ $contact->name }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->address }}</td>
            <td>
                <a href="{{ route( 'contact.show') }}">Voir</a>|
                <a href="{{ route( 'contact.edit') }}">Modifier</a>|
                    <form action="{{ route('contact.destroy',$contact->id) }}"method="POST" style="display:inline">
                        @method('DELETE')
                        <button type="sumbit">Supprimer</button>
                    </form>
            </td>
         </tr>
        @endforeach
       
    </tbody>
</table>
   
</body>
</html>
