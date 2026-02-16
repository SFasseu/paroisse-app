<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact</title>
</head>
<body >
    <strong>+</strong><a href="{{ route('contact.create') }}" style="text-decoration: none;color:green">  Add contact</a><br><br>
    <table border="2">
        <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($contacts as $contact )
                  <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->adress }}</td>
                    <td style="margin: 1px;padding:2px;display:flex">
                        <form action="{{ route('contact.destroy', ) }}" method="post" onsubmit="return confirm('voulez vous vraiment supprimer ce contact')">
                            <button type="submit" title="supprimer" style = "background-color:red;margin: 3px;">delete</button>
                        </form>
                        <form action="{{ route('contact.edit',   ) }}" method="post" >
                            <button type="submit" title="modifier" style = "background-color:yellow;margin: 3px;">update</button>
                        </form>
                       
                    </td>
                  </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>