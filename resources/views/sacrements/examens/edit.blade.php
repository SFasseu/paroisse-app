@extends('sacrements.layouts.sacrements')
@section('title', 'Modifier l\'Examen')
@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.examens.index') }}" style="color:#1A3A6B">Examens</a></li>
    <li class="breadcrumb-item active">Modifier</li>
</ol></nav>
<div class="card" style="max-width:750px">
    <div class="card-header fw-bold" style="background:#1A3A6B;color:#fff">
        <i class="bi bi-pencil me-2"></i>Modifier : {{ $examen->titre }}
    </div>
    <div class="card-body">
        <form action="{{ route('sacrements.examens.update', $examen) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold">Niveau <span class="text-danger">*</span></label>
                <select name="niveau_formation_id" class="form-select" required>
                    @foreach($niveaux as $n)
                    <option value="{{ $n->id }}" {{ old('niveau_formation_id', $examen->niveau_formation_id)==$n->id?'selected':'' }}>{{ $n->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Titre <span class="text-danger">*</span></label>
                <input type="text" name="titre" class="form-control" value="{{ old('titre', $examen->titre) }}" required>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Type</label>
                    <select name="type" class="form-select" required>
                        @foreach(['ecrit'=>'Écrit','oral'=>'Oral','pratique'=>'Pratique','mixte'=>'Mixte'] as $k=>$v)
                        <option value="{{ $k }}" {{ old('type',$examen->type)==$k?'selected':'' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Note maximale</label>
                    <input type="number" name="note_maximale" class="form-control" value="{{ old('note_maximale', $examen->note_maximale) }}" step="0.5" min="1">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Note de passage</label>
                    <input type="number" name="note_passage" class="form-control" value="{{ old('note_passage', $examen->note_passage) }}" step="0.5" min="0">
                </div>
            </div>
            <div class="mb-3 mt-3">
                <label class="form-label fw-semibold">Date</label>
                <input type="date" name="date_examen" class="form-control" value="{{ old('date_examen', $examen->date_examen?->format('Y-m-d')) }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $examen->description) }}</textarea>
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="actif" id="actif" value="1" {{ $examen->actif?'checked':'' }}>
                <label class="form-check-label" for="actif">Actif</label>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom"><i class="bi bi-check-circle me-1"></i>Mettre à jour</button>
                <a href="{{ route('sacrements.examens.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
