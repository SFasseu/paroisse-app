@extends('sacrements.layouts.sacrements')
@section('title', $catechiste->nom_complet)
@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.catechistes.index') }}" style="color:#1A3A6B">Catéchistes</a></li>
    <li class="breadcrumb-item active">{{ $catechiste->nom_complet }}</li>
</ol></nav>
<div class="d-flex justify-content-between align-items-start mb-4">
    <div class="d-flex align-items-center gap-3">
        @if($catechiste->photo)
        <img src="{{ Storage::url($catechiste->photo) }}" alt="Photo"
             class="rounded-circle" style="width:80px;height:80px;object-fit:cover;border:3px solid #1A3A6B">
        @else
        <div class="rounded-circle d-flex align-items-center justify-content-center"
             style="width:80px;height:80px;background:#e8f0fb;border:3px solid #1A3A6B">
            <i class="bi bi-person-fill fs-1" style="color:#1A3A6B"></i>
        </div>
        @endif
        <div>
            <h2 class="fw-bold mb-0" style="color:#1A3A6B">{{ $catechiste->nom_complet }}</h2>
            <p class="text-muted mb-1">{{ $catechiste->specialite ?? 'Catéchiste' }}</p>
            <span class="badge {{ $catechiste->actif ? 'bg-success' : 'bg-secondary' }}">
                {{ $catechiste->actif ? 'Actif' : 'Inactif' }}
            </span>
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('sacrements.catechistes.edit', $catechiste) }}" class="btn btn-warning">
            <i class="bi bi-pencil me-1"></i>Modifier
        </a>
        <a href="{{ route('sacrements.catechistes.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Retour
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header fw-semibold" style="background:#1A3A6B;color:#fff">
                <i class="bi bi-person me-2"></i>Informations personnelles
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-5">Téléphone</dt>
                    <dd class="col-sm-7">{{ $catechiste->telephone ?? '—' }}</dd>
                    <dt class="col-sm-5">Email</dt>
                    <dd class="col-sm-7">{{ $catechiste->email ?? '—' }}</dd>
                    <dt class="col-sm-5">Naissance</dt>
                    <dd class="col-sm-7">{{ $catechiste->date_naissance ? $catechiste->date_naissance->format('d/m/Y') : '—' }}</dd>
                    <dt class="col-sm-5">Engagement</dt>
                    <dd class="col-sm-7">{{ $catechiste->date_engagement ? $catechiste->date_engagement->format('d/m/Y') : '—' }}</dd>
                    <dt class="col-sm-5">Spécialité</dt>
                    <dd class="col-sm-7">{{ $catechiste->specialite ?? '—' }}</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card h-100">
            <div class="card-header fw-semibold" style="background:#1A3A6B;color:#fff">
                <i class="bi bi-collection me-2"></i>Groupes animés ({{ $catechiste->groupes->count() }})
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead style="background:#F0F4FF">
                        <tr><th>Groupe</th><th>Niveau</th><th>Année</th><th>Rôle</th><th></th></tr>
                    </thead>
                    <tbody>
                        @forelse($catechiste->groupes as $groupe)
                        <tr>
                            <td class="fw-semibold">{{ $groupe->nom }}</td>
                            <td>{{ $groupe->niveauFormation->nom ?? '—' }}</td>
                            <td>{{ $groupe->annee_pastorale }}</td>
                            <td>
                                <span class="badge {{ $groupe->pivot->role == 'principal' ? 'bg-primary' : 'bg-secondary' }}">
                                    {{ ucfirst($groupe->pivot->role) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('sacrements.groupes.show', $groupe) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-3">Aucun groupe assigné.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
