<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-white p-5 rounded shadow" style="width: 100%; max-width: 450px;">
        <h2 class="text-center mb-4">Détails du Contact</h2>
        
        <div class="mb-3">
            <label class="form-label fw-bold">ID</label>
            <p class="form-control-plaintext">{{ $contact->id }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Nom</label>
            <p class="form-control-plaintext">{{ $contact->name }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Email</label>
            <p class="form-control-plaintext"><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Adresse</label>
            <p class="form-control-plaintext">{{ $contact->address }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Téléphone</label>
            <p class="form-control-plaintext"><a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a></p>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Créé le</label>
            <p class="form-control-plaintext">{{ $contact->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Modifié le</label>
            <p class="form-control-plaintext">{{ $contact->updated_at->format('d/m/Y H:i') }}</p>
        </div>

        <a href="/contact/{{ $contact->id }}/edit" class="btn btn-warning w-100 mb-2">Modifier</a>
        <a href="/contact" class="btn btn-secondary w-100">← Retour</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
