<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>Détails du contact</h1>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('contact.index') }}" class="btn btn-secondary">Retour à la liste</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>ID:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $contact->id }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Nom:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $contact->name }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Téléphone:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $contact->phone }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Email:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $contact->email ?? '-' }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Adresse:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $contact->address }}
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3">
                        <strong>Créé le:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $contact->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>

                    <div class="col-md-9">
                        {{ $contact->updated_at->format('d/m/Y H:i') }}
                    </div>
                </div>

                <div class="d-flex gap-2">

                    <form action="{{ route('contact.destroy', $contact) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
