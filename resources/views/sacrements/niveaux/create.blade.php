@extends('sacrements.layouts.sacrements')
@section('title', 'Nouveau Niveau')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('sacrements.dashboard') }}" style="color:#1A3A6B">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('sacrements.niveaux.index') }}" style="color:#1A3A6B">Niveaux</a></li>
        <li class="breadcrumb-item active">Nouveau</li>
    </ol>
</nav>

<div class="card" style="max-width:700px">
    <div class="card-header fw-bold" style="background:#1A3A6B;color:#fff">
        <i class="bi bi-plus-circle me-2"></i>Créer un nouveau niveau de formation
    </div>
    <div class="card-body">
        <form action="{{ route('sacrements.niveaux.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Nom du niveau <span class="text-danger">*</span></label>
                <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                       value="{{ old('nom') }}" placeholder="ex: Éveil à la foi" required>
                @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Ordre <span class="text-danger">*</span></label>
                    <input type="number" name="ordre" class="form-control @error('ordre') is-invalid @enderror"
                           value="{{ old('ordre') }}" min="1" placeholder="1" required>
                    @error('ordre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Durée (mois) <span class="text-danger">*</span></label>
                    <input type="number" name="duree_mois" class="form-control @error('duree_mois') is-invalid @enderror"
                           value="{{ old('duree_mois') }}" min="1" placeholder="12" required>
                    @error('duree_mois')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Âge minimum</label>
                    <input type="number" name="age_minimum" class="form-control @error('age_minimum') is-invalid @enderror"
                           value="{{ old('age_minimum') }}" min="0" max="100" placeholder="7">
                    @error('age_minimum')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-3 mt-3">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                          rows="3" placeholder="Description du niveau...">{{ old('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="actif" id="actif" value="1"
                       {{ old('actif', '1') ? 'checked' : '' }}>
                <label class="form-check-label" for="actif">Niveau actif</label>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check-circle me-1"></i> Enregistrer
                </button>
                <a href="{{ route('sacrements.niveaux.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
