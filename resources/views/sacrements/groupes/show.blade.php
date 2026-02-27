@extends('sacrements.layouts.sacrements')
@section('title', $groupe->nom)
@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.groupes.index') }}" style="color:#1A3A6B">Groupes</a></li>
    <li class="breadcrumb-item active">{{ $groupe->nom }}</li>
</ol></nav>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0" style="color:#1A3A6B">{{ $groupe->nom }}</h2>
        <span class="badge" style="background:#1A3A6B">{{ $groupe->niveauFormation->nom ?? '—' }}</span>
        <span class="badge bg-secondary ms-1">{{ $groupe->annee_pastorale }}</span>
        <span class="badge {{ $groupe->actif?'bg-success':'bg-warning' }} ms-1">{{ $groupe->actif?'Actif':'Inactif' }}</span>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('sacrements.groupes.edit', $groupe) }}" class="btn btn-warning"><i class="bi bi-pencil me-1"></i>Modifier</a>
        <a href="{{ route('sacrements.groupes.index') }}" class="btn btn-outline-secondary">Retour</a>
    </div>
</div>
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="fw-bold" style="color:#1A3A6B">Informations du groupe</h6>
                <dl class="row mb-0">
                    <dt class="col-sm-5">Lieu</dt><dd class="col-sm-7">{{ $groupe->lieu_reunion ?? '—' }}</dd>
                    <dt class="col-sm-5">Jour</dt><dd class="col-sm-7">{{ ucfirst($groupe->jour_reunion ?? '—') }}</dd>
                    <dt class="col-sm-5">Heure</dt><dd class="col-sm-7">{{ $groupe->heure_reunion ?? '—' }}</dd>
                    <dt class="col-sm-5">Capacité max.</dt><dd class="col-sm-7">{{ $groupe->capacite_max ?? 'N/A' }}</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="fw-bold" style="color:#1A3A6B">Catéchistes</h6>
                @forelse($groupe->catechistes as $cat)
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <a href="{{ route('sacrements.catechistes.show', $cat) }}" style="color:#1A3A6B;text-decoration:none">
                        <i class="bi bi-person-badge me-1"></i>{{ $cat->nom_complet }}
                    </a>
                    <span class="badge {{ $cat->pivot->role=='principal'?'bg-primary':'bg-secondary' }}">{{ ucfirst($cat->pivot->role) }}</span>
                </div>
                @empty
                <p class="text-muted small">Aucun catéchiste assigné.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header fw-semibold d-flex justify-content-between align-items-center" style="background:#1A3A6B;color:#fff">
        <span><i class="bi bi-people me-2"></i>Catéchumènes membres ({{ $groupe->catechumenes->count() }})</span>
        <a href="{{ route('sacrements.catechumenes.create') }}?groupe={{ $groupe->id }}" class="btn btn-sm btn-outline-light">
            <i class="bi bi-plus"></i> Ajouter
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead style="background:#F0F4FF">
                <tr><th>N° Dossier</th><th>Nom complet</th><th>Sexe</th><th>Statut</th><th></th></tr>
            </thead>
            <tbody>
                @forelse($groupe->catechumenes as $cat)
                <tr>
                    <td class="text-muted small">{{ $cat->numero_dossier }}</td>
                    <td class="fw-semibold">{{ $cat->nom_complet }}</td>
                    <td>{{ $cat->sexe == 'M' ? '♂ Masculin' : '♀ Féminin' }}</td>
                    <td><span class="badge bg-{{ $cat->statut_color }}">{{ $cat->statut_label }}</span></td>
                    <td><a href="{{ route('sacrements.catechumenes.show', $cat) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a></td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Aucun catéchumène dans ce groupe.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
