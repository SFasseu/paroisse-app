@extends('sacrements.layouts.sacrements')
@section('title', 'Groupes de Catéchèse')
@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.dashboard') }}" style="color:#1A3A6B">Tableau de bord</a></li>
    <li class="breadcrumb-item active">Groupes</li>
</ol></nav>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0" style="color:#1A3A6B"><i class="bi bi-collection me-2"></i>Groupes de Catéchèse</h2>
    <a href="{{ route('sacrements.groupes.create') }}" class="btn btn-primary-custom"><i class="bi bi-plus-circle me-1"></i> Nouveau Groupe</a>
</div>
<div class="card mb-3"><div class="card-body">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-4">
            <select name="niveau_id" class="form-select">
                <option value="">— Tous les niveaux —</option>
                @foreach($niveaux as $n)
                <option value="{{ $n->id }}" {{ request('niveau_id')==$n->id?'selected':'' }}>{{ $n->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <input type="text" name="annee" class="form-control" placeholder="Année pastorale" value="{{ request('annee') }}">
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-primary" type="submit"><i class="bi bi-filter"></i> Filtrer</button>
            <a href="{{ route('sacrements.groupes.index') }}" class="btn btn-outline-secondary ms-1">Réinitialiser</a>
        </div>
    </form>
</div></div>
<div class="row g-3">
    @forelse($groupes as $groupe)
    <div class="col-md-6 col-lg-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="card-title fw-bold mb-0" style="color:#1A3A6B">{{ $groupe->nom }}</h5>
                    <span class="badge {{ $groupe->actif?'bg-success':'bg-secondary' }}">{{ $groupe->actif?'Actif':'Inactif' }}</span>
                </div>
                <div class="text-muted small mb-3">
                    <i class="bi bi-layers me-1"></i>{{ $groupe->niveauFormation->nom ?? '—' }}<br>
                    <i class="bi bi-calendar me-1"></i>{{ $groupe->annee_pastorale }}<br>
                    @if($groupe->jour_reunion)
                    <i class="bi bi-clock me-1"></i>{{ ucfirst($groupe->jour_reunion) }} à {{ $groupe->heure_reunion ?? '—' }}<br>
                    @endif
                    @if($groupe->lieu_reunion)
                    <i class="bi bi-geo-alt me-1"></i>{{ $groupe->lieu_reunion }}
                    @endif
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="badge rounded-pill bg-light text-dark border">
                            <i class="bi bi-people me-1"></i>{{ $groupe->catechumenes->count() }} catéchumènes
                        </span>
                    </div>
                    <div class="d-flex gap-1">
                        <a href="{{ route('sacrements.groupes.show', $groupe) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('sacrements.groupes.edit', $groupe) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('sacrements.groupes.destroy', $groupe) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer ce groupe ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12"><div class="alert alert-info">Aucun groupe trouvé.</div></div>
    @endforelse
</div>
@if($groupes->hasPages())<div class="mt-3">{{ $groupes->links() }}</div>@endif
@endsection
