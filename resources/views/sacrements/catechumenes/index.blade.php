@extends('sacrements.layouts.sacrements')
@section('title', 'Catéchumènes')
@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.dashboard') }}" style="color:#1A3A6B">Tableau de bord</a></li>
    <li class="breadcrumb-item active">Catéchumènes</li>
</ol></nav>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0" style="color:#1A3A6B"><i class="bi bi-people-fill me-2"></i>Catéchumènes</h2>
    <a href="{{ route('sacrements.catechumenes.create') }}" class="btn btn-primary-custom">
        <i class="bi bi-plus-circle me-1"></i> Nouveau Catéchumène
    </a>
</div>

{{-- Filtres --}}
<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label small fw-semibold">Recherche</label>
                <input type="text" name="search" class="form-control"
                       placeholder="Nom, prénom, numéro dossier..."
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-semibold">Statut</label>
                <select name="statut" class="form-select">
                    <option value="">— Tous les statuts —</option>
                    @foreach(['inscrit'=>'Inscrit','en_cours'=>'En cours','suspendu'=>'Suspendu','diplome'=>'Diplômé','abandonne'=>'Abandonné'] as $k=>$v)
                    <option value="{{ $k }}" {{ request('statut')==$k ? 'selected' : '' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-semibold">Groupe</label>
                <select name="groupe_id" class="form-select">
                    <option value="">— Tous les groupes —</option>
                    @foreach($groupes as $g)
                    <option value="{{ $g->id }}" {{ request('groupe_id')==$g->id ? 'selected' : '' }}>{{ $g->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-primary w-100" type="submit">
                    <i class="bi bi-filter"></i> Filtrer
                </button>
            </div>
        </form>
        @if(request()->hasAny(['search','statut','groupe_id']))
        <div class="mt-2">
            <a href="{{ route('sacrements.catechumenes.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-x-circle me-1"></i>Réinitialiser les filtres
            </a>
        </div>
        @endif
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead style="background:#1A3A6B;color:#fff">
                <tr>
                    <th>N° Dossier</th>
                    <th>Nom complet</th>
                    <th>Groupe</th>
                    <th>Sexe</th>
                    <th>Inscription</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($catechumenes as $cat)
                <tr>
                    <td class="text-muted small font-monospace">{{ $cat->numero_dossier }}</td>
                    <td>
                        <div class="fw-semibold">{{ $cat->nom_complet }}</div>
                        <div class="text-muted small">{{ $cat->date_naissance ? $cat->date_naissance->format('d/m/Y') : '' }}</div>
                    </td>
                    <td>
                        @if($cat->groupeCatechese)
                        <span class="badge" style="background:#1A3A6B;font-size:.75rem">
                            {{ Str::limit($cat->groupeCatechese->nom, 25) }}
                        </span>
                        @else
                        <span class="text-muted small">—</span>
                        @endif
                    </td>
                    <td>{{ $cat->sexe == 'M' ? '♂' : '♀' }}</td>
                    <td class="small">{{ $cat->date_inscription ? $cat->date_inscription->format('d/m/Y') : '—' }}</td>
                    <td>
                        <span class="badge bg-{{ $cat->statut_color }}">{{ $cat->statut_label }}</span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('sacrements.catechumenes.show', $cat) }}"
                           class="btn btn-sm btn-outline-primary" title="Voir le dossier">
                            <i class="bi bi-folder2-open"></i>
                        </a>
                        <a href="{{ route('sacrements.catechumenes.edit', $cat) }}"
                           class="btn btn-sm btn-outline-warning" title="Modifier">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('sacrements.catechumenes.destroy', $cat) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Êtes-vous sûr de vouloir archiver ce catéchumène ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" title="Archiver">
                                <i class="bi bi-archive"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-5">
                        <i class="bi bi-people display-4 d-block mb-2"></i>
                        Aucun catéchumène trouvé.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($catechumenes->hasPages())
    <div class="card-footer">
        {{ $catechumenes->links() }}
    </div>
    @endif
</div>
@endsection
