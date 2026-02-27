@extends('sacrements.layouts.sacrements')
@section('title', 'Nouvel Examen')
@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.examens.index') }}" style="color:#1A3A6B">Examens</a></li>
    <li class="breadcrumb-item active">Nouveau</li>
</ol></nav>
<div class="card" style="max-width:750px">
    <div class="card-header fw-bold" style="background:#1A3A6B;color:#fff">
        <i class="bi bi-plus-circle me-2"></i>Créer un nouvel examen
    </div>
    <div class="card-body">
        <form action="{{ route('sacrements.examens.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Niveau <span class="text-danger">*</span></label>
                <select name="niveau_formation_id" class="form-select @error('niveau_formation_id') is-invalid @enderror" required>
                    <option value="">— Sélectionner un niveau —</option>
                    @foreach($niveaux as $n)
                    <option value="{{ $n->id }}" {{ old('niveau_formation_id')==$n->id?'selected':'' }}>{{ $n->nom }}</option>
                    @endforeach
                </select>
                @error('niveau_formation_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Titre <span class="text-danger">*</span></label>
                <input type="text" name="titre" class="form-control @error('titre') is-invalid @enderror"
                       value="{{ old('titre') }}" placeholder="ex: Examen de fin de Niveau 1" required>
                @error('titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
                    <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                        @foreach(['ecrit'=>'Écrit','oral'=>'Oral','pratique'=>'Pratique','mixte'=>'Mixte'] as $k=>$v)
                        <option value="{{ $k }}" {{ old('type')==$k?'selected':'' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                    @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Note maximale <span class="text-danger">*</span></label>
                    <input type="number" name="note_maximale" class="form-control" value="{{ old('note_maximale', 20) }}" step="0.5" min="1" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Note de passage <span class="text-danger">*</span></label>
                    <input type="number" name="note_passage" class="form-control" value="{{ old('note_passage', 10) }}" step="0.5" min="0" required>
                </div>
            </div>
            <div class="mb-3 mt-3">
                <label class="form-label fw-semibold">Date de l'examen</label>
                <input type="date" name="date_examen" class="form-control" value="{{ old('date_examen') }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="actif" id="actif" value="1" checked>
                <label class="form-check-label" for="actif">Examen actif</label>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom"><i class="bi bi-check-circle me-1"></i>Enregistrer</button>
                <a href="{{ route('sacrements.examens.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
