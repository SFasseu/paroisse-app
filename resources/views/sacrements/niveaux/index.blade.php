@extends('sacrements.layouts.sacrements')
@section('title', 'Niveaux de Formation')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('sacrements.dashboard') }}" style="color:#1A3A6B">Tableau de bord</a></li>
        <li class="breadcrumb-item active">Niveaux</li>
    </ol>
</nav>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0" style="color:#1A3A6B"><i class="bi bi-layers me-2"></i>Niveaux de Formation</h2>
    <a href="{{ route('sacrements.niveaux.create') }}" class="btn btn-primary-custom">
        <i class="bi bi-plus-circle me-1"></i> Nouveau Niveau
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background:#1A3A6B;color:#fff">
                    <tr>
                        <th>Ordre</th>
                        <th>Nom</th>
                        <th>Durée</th>
                        <th>Âge min.</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($niveaux as $niveau)
                    <tr>
                        <td><span class="badge rounded-pill" style="background:#1A3A6B">{{ $niveau->ordre }}</span></td>
                        <td>
                            <div class="fw-semibold">{{ $niveau->nom }}</div>
                            @if($niveau->description)
                            <div class="text-muted small">{{ Str::limit($niveau->description, 60) }}</div>
                            @endif
                        </td>
                        <td>{{ $niveau->duree_mois }} mois</td>
                        <td>{{ $niveau->age_minimum ? $niveau->age_minimum . ' ans' : '—' }}</td>
                        <td>
                            @if($niveau->actif)
                            <span class="badge bg-success">Actif</span>
                            @else
                            <span class="badge bg-secondary">Inactif</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('sacrements.niveaux.show', $niveau) }}"
                               class="btn btn-sm btn-outline-primary" title="Voir">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('sacrements.niveaux.edit', $niveau) }}"
                               class="btn btn-sm btn-outline-warning" title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('sacrements.niveaux.destroy', $niveau) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce niveau ?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Supprimer">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Aucun niveau configuré.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($niveaux->hasPages())
    <div class="card-footer">
        {{ $niveaux->links() }}
    </div>
    @endif
</div>
@endsection
