@extends('sacrements.layouts.sacrements')
@section('title', 'Modifier le Cours')
@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.cours.index') }}" style="color:#1A3A6B">Cours</a></li>
    <li class="breadcrumb-item active">Modifier</li>
</ol></nav>
<div class="card" style="max-width:750px">
    <div class="card-header fw-bold" style="background:#1A3A6B;color:#fff">
        <i class="bi bi-pencil me-2"></i>Modifier : {{ $cours->titre }}
    </div>
    <div class="card-body">
        <form action="{{ route('sacrements.cours.update', $cours) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold">Niveau de formation <span class="text-danger">*</span></label>
                <select name="niveau_formation_id" class="form-select" required>
                    <option value="">— Sélectionner —</option>
                    @foreach($niveaux as $n)
                    <option value="{{ $n->id }}" {{ old('niveau_formation_id', $cours->niveau_formation_id)==$n->id?'selected':'' }}>{{ $n->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Titre <span class="text-danger">*</span></label>
                <input type="text" name="titre" class="form-control" value="{{ old('titre', $cours->titre) }}" required>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Ordre <span class="text-danger">*</span></label>
                    <input type="number" name="ordre" class="form-control" value="{{ old('ordre', $cours->ordre) }}" min="1" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Durée (heures)</label>
                    <input type="number" name="duree_heures" step="0.5" class="form-control" value="{{ old('duree_heures', $cours->duree_heures) }}">
                </div>
            </div>
            <div class="mb-3 mt-3">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $cours->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Objectifs</label>
                <textarea name="objectifs" class="form-control" rows="2">{{ old('objectifs', $cours->objectifs) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Matériel requis</label>
                <textarea name="materiel_requis" class="form-control" rows="2">{{ old('materiel_requis', $cours->materiel_requis) }}</textarea>
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="actif" id="actif" value="1" {{ $cours->actif?'checked':'' }}>
                <label class="form-check-label" for="actif">Cours actif</label>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom"><i class="bi bi-check-circle me-1"></i> Mettre à jour</button>
                <a href="{{ route('sacrements.cours.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
