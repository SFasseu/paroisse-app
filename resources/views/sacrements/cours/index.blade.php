@extends('sacrements.layouts.sacrements')
@section('title', 'Cours')
@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.dashboard') }}" style="color:#1A3A6B">Tableau de bord</a></li>
    <li class="breadcrumb-item active">Cours</li>
</ol></nav>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0" style="color:#1A3A6B"><i class="bi bi-book me-2"></i>Cours</h2>
    <a href="{{ route('sacrements.cours.create') }}" class="btn btn-primary-custom">
        <i class="bi bi-plus-circle me-1"></i> Nouveau Cours
    </a>
</div>
<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-semibold mb-2">Filtrer par niveau</label>
                <select name="niveau_id" class="form-select">
                    <option value="">— Tous les niveaux —</option>
                    @foreach($niveaux as $n)
                    <option value="{{ $n->id }}" {{ request('niveau_id')==$n->id?'selected':'' }}>{{ $n->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-primary" type="submit"><i class="bi bi-filter me-1"></i>Filtrer</button>
                <a href="{{ route('sacrements.cours.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead style="background:#1A3A6B;color:#fff">
                <tr><th>N°</th><th>Titre</th><th>Niveau</th><th>Durée</th><th>Statut</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($cours as $c)
                <tr>
                    <td>{{ $c->ordre }}</td>
                    <td>
                        <div class="fw-semibold">{{ $c->titre }}</div>
                        <div class="text-muted small">{{ Str::limit($c->description, 50) }}</div>
                    </td>
                    <td><span class="badge" style="background:#1A3A6B">{{ $c->niveauFormation->nom ?? '—' }}</span></td>
                    <td>{{ $c->duree_heures ? $c->duree_heures.'h' : '—' }}</td>
                    <td><span class="badge {{ $c->actif?'bg-success':'bg-secondary' }}">{{ $c->actif?'Actif':'Inactif' }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('sacrements.cours.edit', $c) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('sacrements.cours.destroy', $c) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Aucun cours trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($cours->hasPages())<div class="card-footer">{{ $cours->links() }}</div>@endif
</div>
@endsection
