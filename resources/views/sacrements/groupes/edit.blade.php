@extends('sacrements.layouts.sacrements')
@section('title', 'Modifier le Groupe')
@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.groupes.index') }}" style="color:#1A3A6B">Groupes</a></li>
    <li class="breadcrumb-item active">Modifier</li>
</ol></nav>
<div class="card" style="max-width:800px">
    <div class="card-header fw-bold" style="background:#1A3A6B;color:#fff">
        <i class="bi bi-pencil me-2"></i>Modifier : {{ $groupe->nom }}
    </div>
    <div class="card-body">
        <form action="{{ route('sacrements.groupes.update', $groupe) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Nom du groupe <span class="text-danger">*</span></label>
                    <input type="text" name="nom" class="form-control" value="{{ old('nom', $groupe->nom) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Année pastorale <span class="text-danger">*</span></label>
                    <input type="text" name="annee_pastorale" class="form-control" value="{{ old('annee_pastorale', $groupe->annee_pastorale) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Niveau de formation <span class="text-danger">*</span></label>
                    <select name="niveau_formation_id" class="form-select" required>
                        @foreach($niveaux as $n)
                        <option value="{{ $n->id }}" {{ old('niveau_formation_id',$groupe->niveau_formation_id)==$n->id?'selected':'' }}>{{ $n->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Capacité maximale</label>
                    <input type="number" name="capacite_max" class="form-control" value="{{ old('capacite_max', $groupe->capacite_max) }}" min="1">
                </div>
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Lieu de réunion</label>
                    <input type="text" name="lieu_reunion" class="form-control" value="{{ old('lieu_reunion', $groupe->lieu_reunion) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Heure</label>
                    <input type="time" name="heure_reunion" class="form-control" value="{{ old('heure_reunion', $groupe->heure_reunion) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Jour</label>
                    <select name="jour_reunion" class="form-select">
                        <option value="">—</option>
                        @foreach(['lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche'] as $j)
                        <option value="{{ $j }}" {{ old('jour_reunion',$groupe->jour_reunion)==$j?'selected':'' }}>{{ ucfirst($j) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <hr class="my-4">
            <h6 class="fw-bold mb-3" style="color:#1A3A6B">Catéchistes</h6>
            <div class="row g-2">
                @foreach($catechistes as $cat)
                <div class="col-md-6">
                    <div class="border rounded p-2 d-flex align-items-center gap-2">
                        <input type="checkbox" name="catechistes[]" value="{{ $cat->id }}"
                               id="cat_{{ $cat->id }}" class="form-check-input"
                               {{ in_array($cat->id, old('catechistes', $catechistesActuels)) ? 'checked' : '' }}>
                        <label for="cat_{{ $cat->id }}" class="flex-grow-1 mb-0">{{ $cat->nom_complet }}</label>
                        <select name="roles[{{ $cat->id }}]" class="form-select form-select-sm" style="width:120px">
                            @php $pivotRole = $groupe->catechistes->find($cat->id)?->pivot->role ?? 'assistant'; @endphp
                            <option value="assistant" {{ $pivotRole=='assistant'?'selected':'' }}>Assistant</option>
                            <option value="principal" {{ $pivotRole=='principal'?'selected':'' }}>Principal</option>
                        </select>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="form-check mt-3 mb-4">
                <input class="form-check-input" type="checkbox" name="actif" id="actif" value="1" {{ $groupe->actif?'checked':'' }}>
                <label class="form-check-label" for="actif">Groupe actif</label>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom"><i class="bi bi-check-circle me-1"></i>Mettre à jour</button>
                <a href="{{ route('sacrements.groupes.show', $groupe) }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
