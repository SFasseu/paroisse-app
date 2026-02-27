@extends('sacrements.layouts.sacrements')
@section('title', 'Modifier le Sacrement')

@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.catechumenes.index') }}" style="color:#1A3A6B">Catéchumènes</a></li>
    <li class="breadcrumb-item">
        <a href="{{ route('sacrements.catechumenes.show', $sacrement->catechumene) }}" style="color:#1A3A6B">
            {{ $sacrement->catechumene->nom_complet }}
        </a>
    </li>
    <li class="breadcrumb-item active">Modifier le sacrement</li>
</ol></nav>

<div class="card" style="max-width:750px">
    <div class="card-header fw-bold" style="background:#1A3A6B;color:#fff">
        <i class="bi bi-pencil me-2"></i>Modifier : {{ $sacrement->type_label }}
        <span class="badge bg-light text-dark ms-2">{{ $sacrement->catechumene->nom_complet }}</span>
    </div>
    <div class="card-body">
        <form action="{{ route('sacrements.sacrements.update', $sacrement) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Type de sacrement <span class="text-danger">*</span></label>
                    <select name="type_sacrement" class="form-select @error('type_sacrement') is-invalid @enderror" required>
                        @foreach([
                            'bapteme'            => 'Baptême',
                            'premiere_communion' => 'Première Communion',
                            'confirmation'       => 'Confirmation',
                            'mariage'            => 'Mariage',
                            'ordre'              => 'Ordre',
                        ] as $k => $v)
                        <option value="{{ $k }}" {{ old('type_sacrement', $sacrement->type_sacrement)==$k?'selected':'' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                    @error('type_sacrement')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Date du sacrement <span class="text-danger">*</span></label>
                    <input type="date" name="date_sacrement" class="form-control @error('date_sacrement') is-invalid @enderror"
                           value="{{ old('date_sacrement', $sacrement->date_sacrement?->format('Y-m-d')) }}" required>
                    @error('date_sacrement')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Lieu du sacrement</label>
                    <input type="text" name="lieu_sacrement" class="form-control"
                           value="{{ old('lieu_sacrement', $sacrement->lieu_sacrement) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">N° de registre</label>
                    <input type="text" name="numero_registre" class="form-control"
                           value="{{ old('numero_registre', $sacrement->numero_registre) }}">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Prêtre officiant</label>
                    <input type="text" name="pretre_officiant" class="form-control"
                           value="{{ old('pretre_officiant', $sacrement->pretre_officiant) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Parrain</label>
                    <input type="text" name="parrain" class="form-control"
                           value="{{ old('parrain', $sacrement->parrain) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Marraine</label>
                    <input type="text" name="marraine" class="form-control"
                           value="{{ old('marraine', $sacrement->marraine) }}">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Observations</label>
                    <textarea name="observations" class="form-control" rows="3">{{ old('observations', $sacrement->observations) }}</textarea>
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check-circle me-1"></i>Mettre à jour
                </button>
                <a href="{{ route('sacrements.catechumenes.show', $sacrement->catechumene) }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
