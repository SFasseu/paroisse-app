<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>contact</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <div style="margin-bottom: 15px;">
        <a href="{{ route('contacts.create') }}">
            <button type="button">Add Contact</button>
        </a>
    </div>
    <table border="2">
        <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->id }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->address }}</td>
                <td>
                    <a href="{{ route('contacts.edit', $contact->id) }}">
                        <button type="button">Edit</button>
                    </a>
                    <form action="{{ route('contacts.destroy', $contact->id) }}"
                        method="POST"
                        style="display: inline-block;"
                        onsubmit="return confirm('voulez-vous vraiment supprimer ?')">

                        @csrf
                        @method('delete')
                        <button type="submit">Delete</button>
                    </form>

                </td>
                </tr>    
            @endforeach

        </tbody>
    </table>
</body>
</html>
