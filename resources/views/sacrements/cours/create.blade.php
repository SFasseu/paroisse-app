@extends('sacrements.layouts.sacrements')
@section('title', 'Nouveau Cours')
@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.dashboard') }}" style="color:#1A3A6B">Tableau de bord</a></li>
    <li class="breadcrumb-item"><a href="{{ route('sacrements.cours.index') }}" style="color:#1A3A6B">Cours</a></li>
    <li class="breadcrumb-item active">Nouveau</li>
</ol></nav>
<div class="card" style="max-width:750px">
    <div class="card-header fw-bold" style="background:#1A3A6B;color:#fff">
        <i class="bi bi-plus-circle me-2"></i>Créer un nouveau cours
    </div>
    <div class="card-body">
        <form action="{{ route('sacrements.cours.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Niveau de formation <span class="text-danger">*</span></label>
                <select name="niveau_formation_id" class="form-select @error('niveau_formation_id') is-invalid @enderror" required>
                    <option value="">— Sélectionner un niveau —</option>
                    @foreach($niveaux as $n)
                    <option value="{{ $n->id }}" {{ old('niveau_formation_id')==$n->id?'selected':'' }}>{{ $n->nom }}</option>
                    @endforeach
                </select>
                @error('niveau_formation_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Titre du cours <span class="text-danger">*</span></label>
                <input type="text" name="titre" class="form-control @error('titre') is-invalid @enderror"
                       value="{{ old('titre') }}" placeholder="ex: Qui est Dieu ?" required>
                @error('titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Ordre <span class="text-danger">*</span></label>
                    <input type="number" name="ordre" class="form-control @error('ordre') is-invalid @enderror"
                           value="{{ old('ordre', 1) }}" min="1" required>
                    @error('ordre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Durée (heures)</label>
                    <input type="number" name="duree_heures" step="0.5" class="form-control @error('duree_heures') is-invalid @enderror"
                           value="{{ old('duree_heures') }}" min="0" placeholder="ex: 2.5">
                    @error('duree_heures')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-3 mt-3">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Description du cours...">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Objectifs pédagogiques</label>
                <textarea name="objectifs" class="form-control" rows="2" placeholder="À la fin de ce cours, l'élève sera capable de...">{{ old('objectifs') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Matériel requis</label>
                <textarea name="materiel_requis" class="form-control" rows="2" placeholder="Bible, cahier de catéchèse...">{{ old('materiel_requis') }}</textarea>
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="actif" id="actif" value="1" checked>
                <label class="form-check-label" for="actif">Cours actif</label>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom"><i class="bi bi-check-circle me-1"></i> Enregistrer</button>
                <a href="{{ route('sacrements.cours.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
