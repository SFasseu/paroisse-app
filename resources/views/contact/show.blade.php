<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body style="margin: auto;">
    <table border="1" width="80%" class="border px-3 table table-alternative table-responsive mt-3">
        <thead>
            <th class="text-center">Id</th>
            <th class="text-center">Name</th>
            <th class="text-center">phone</th>
            <th class="text-center">Email</th>
            <th class="text-center">Address</th>
            <th class="text-center">More Action</th>
        </thead>
        <tbody>
            <tr>
                <td>{{ $contact->id }}</td>
                <td>{{ $contact->phone }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->address }}</td>
                <td class="d-flex justify-content-center gap-2">
                    <a href="/contact/id={{ $contact->id }}/edit" class="btn btn-primary w-25 p-2">Edit</a>
                    <a href="/contact/id={{ $contact->id }}/delete" class="btn btn-danger w-25 p-2">Delete</a>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>