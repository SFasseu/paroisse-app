<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Contact</title>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <a href="/contact/create" class="btn btn-primary">Nouveau Contact</a>
            <table class="table table-responsive">
    <thead>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Actions</th>
    </thead>
    <tbody>
        @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->id }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->address }}</td>
                <td>#</td>
            </tr>
        @endforeach
    </tbody>
</table>
        </div>
    </div>
</body>

</html>