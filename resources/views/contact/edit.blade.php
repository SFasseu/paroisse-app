<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-white p-5 rounded shadow" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4">Modifier un Contact</h2>
        
        <form action="/contact/{{ $contact->id }}/edit" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" name="name" value="{{ $contact->name }}" required>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $contact->email }}" required>
            </div>
            
            <div class="mb-3">
                <label for="address" class="form-label">Adresse</label>
                <input type="text" class="form-control" name="address" value="{{ $contact->address }}" required>
            </div>
            
            <div class="mb-4">
                <label for="phone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" name="phone" value="{{ $contact->phone }}" required>
            </div>

            <button type="submit" class="btn btn-success w-100 mb-2">Enregistrer</button>
            <a href="/contact" class="btn btn-secondary w-100">← Retour</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
