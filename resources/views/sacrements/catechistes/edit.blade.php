@extends('sacrements.layouts.sacrements')
@section('title', 'Modifier le Catéchiste')
@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.catechistes.index') }}" style="color:#1A3A6B">Catéchistes</a></li>
    <li class="breadcrumb-item active">Modifier</li>
</ol></nav>
<div class="card" style="max-width:750px">
    <div class="card-header fw-bold" style="background:#1A3A6B;color:#fff">
        <i class="bi bi-pencil me-2"></i>Modifier : {{ $catechiste->nom_complet }}
    </div>
    <div class="card-body">
        @if($catechiste->photo)
        <div class="text-center mb-3">
            <img src="{{ Storage::url($catechiste->photo) }}" alt="Photo actuelle"
                 class="rounded-circle" style="width:80px;height:80px;object-fit:cover;border:3px solid #1A3A6B">
            <div class="text-muted small mt-1">Photo actuelle</div>
        </div>
        @endif
        <form action="{{ route('sacrements.catechistes.update', $catechiste) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                    <input type="text" name="nom" class="form-control" value="{{ old('nom', $catechiste->nom) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Prénom <span class="text-danger">*</span></label>
                    <input type="text" name="prenom" class="form-control" value="{{ old('prenom', $catechiste->prenom) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Téléphone</label>
                    <input type="text" name="telephone" class="form-control" value="{{ old('telephone', $catechiste->telephone) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $catechiste->email) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Date de naissance</label>
                    <input type="date" name="date_naissance" class="form-control" value="{{ old('date_naissance', $catechiste->date_naissance?->format('Y-m-d')) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Date d'engagement</label>
                    <input type="date" name="date_engagement" class="form-control" value="{{ old('date_engagement', $catechiste->date_engagement?->format('Y-m-d')) }}">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Spécialité</label>
                    <input type="text" name="specialite" class="form-control" value="{{ old('specialite', $catechiste->specialite) }}">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Nouvelle photo (laisser vide pour conserver l'actuelle)</label>
                    <input type="file" name="photo" class="form-control" accept="image/jpeg,image/png,image/jpg,image/gif">
                    <div class="form-text">Taille max : 2 Mo.</div>
                </div>
            </div>
            <div class="form-check mt-3 mb-4">
                <input class="form-check-input" type="checkbox" name="actif" id="actif" value="1" {{ $catechiste->actif?'checked':'' }}>
                <label class="form-check-label" for="actif">Actif</label>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom"><i class="bi bi-check-circle me-1"></i>Mettre à jour</button>
                <a href="{{ route('sacrements.catechistes.show', $catechiste) }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
