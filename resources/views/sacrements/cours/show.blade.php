@extends('sacrements.layouts.sacrements')
@section('title', $cours->titre)
@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.cours.index') }}" style="color:#1A3A6B">Cours</a></li>
    <li class="breadcrumb-item active">{{ $cours->titre }}</li>
</ol></nav>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0" style="color:#1A3A6B">{{ $cours->titre }}</h2>
        <span class="badge" style="background:#1A3A6B">{{ $cours->niveauFormation->nom ?? '—' }}</span>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('sacrements.cours.edit', $cours) }}" class="btn btn-warning"><i class="bi bi-pencil me-1"></i>Modifier</a>
        <a href="{{ route('sacrements.cours.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Retour</a>
    </div>
</div>
<div class="row g-3">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="fw-bold mb-2" style="color:#1A3A6B">Description</h6>
                <p>{{ $cours->description ?? 'Aucune description fournie.' }}</p>
                @if($cours->objectifs)
                <h6 class="fw-bold mb-2 mt-3" style="color:#1A3A6B">Objectifs pédagogiques</h6>
                <p>{{ $cours->objectifs }}</p>
                @endif
                @if($cours->materiel_requis)
                <h6 class="fw-bold mb-2 mt-3" style="color:#1A3A6B">Matériel requis</h6>
                <p>{{ $cours->materiel_requis }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-6">Ordre</dt><dd class="col-sm-6">{{ $cours->ordre }}</dd>
                    <dt class="col-sm-6">Durée</dt><dd class="col-sm-6">{{ $cours->duree_heures ? $cours->duree_heures.'h' : '—' }}</dd>
                    <dt class="col-sm-6">Statut</dt>
                    <dd class="col-sm-6"><span class="badge {{ $cours->actif?'bg-success':'bg-secondary' }}">{{ $cours->actif?'Actif':'Inactif' }}</span></dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
