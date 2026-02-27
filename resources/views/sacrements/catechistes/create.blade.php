@extends('sacrements.layouts.sacrements')
@section('title', 'Nouveau Catéchiste')
@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.catechistes.index') }}" style="color:#1A3A6B">Catéchistes</a></li>
    <li class="breadcrumb-item active">Nouveau</li>
</ol></nav>
<div class="card" style="max-width:750px">
    <div class="card-header fw-bold" style="background:#1A3A6B;color:#fff">
        <i class="bi bi-person-plus me-2"></i>Enregistrer un nouveau catéchiste
    </div>
    <div class="card-body">
        <form action="{{ route('sacrements.catechistes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                    <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                           value="{{ old('nom') }}" required>
                    @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Prénom <span class="text-danger">*</span></label>
                    <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror"
                           value="{{ old('prenom') }}" required>
                    @error('prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Téléphone</label>
                    <input type="text" name="telephone" class="form-control" value="{{ old('telephone') }}" placeholder="+237 6XX XXX XXX">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Date de naissance</label>
                    <input type="date" name="date_naissance" class="form-control" value="{{ old('date_naissance') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Date d'engagement</label>
                    <input type="date" name="date_engagement" class="form-control" value="{{ old('date_engagement') }}">
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Spécialité</label>
                    <input type="text" name="specialite" class="form-control" value="{{ old('specialite') }}" placeholder="ex: Niveaux 1 et 2">
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Photo de profil</label>
                    <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror"
                           accept="image/jpeg,image/png,image/jpg,image/gif">
                    <div class="form-text">Formats acceptés : JPEG, PNG, JPG, GIF. Taille max : 2 Mo.</div>
                    @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="form-check mt-3 mb-4">
                <input class="form-check-input" type="checkbox" name="actif" id="actif" value="1" checked>
                <label class="form-check-label" for="actif">Catéchiste actif</label>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom"><i class="bi bi-check-circle me-1"></i>Enregistrer</button>
                <a href="{{ route('sacrements.catechistes.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
