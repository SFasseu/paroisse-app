@extends('sacrements.layouts.sacrements')
@section('title', 'Examens')
@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.dashboard') }}" style="color:#1A3A6B">Tableau de bord</a></li>
    <li class="breadcrumb-item active">Examens</li>
</ol></nav>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0" style="color:#1A3A6B"><i class="bi bi-pencil-square me-2"></i>Examens</h2>
    <a href="{{ route('sacrements.examens.create') }}" class="btn btn-primary-custom"><i class="bi bi-plus-circle me-1"></i> Nouvel Examen</a>
</div>
<div class="card mb-3">
    <div class="card-body">
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
                <select name="type" class="form-select">
                    <option value="">— Tous types —</option>
                    @foreach(['ecrit'=>'Écrit','oral'=>'Oral','pratique'=>'Pratique','mixte'=>'Mixte'] as $k=>$v)
                    <option value="{{ $k }}" {{ request('type')==$k?'selected':'' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-primary" type="submit"><i class="bi bi-filter"></i> Filtrer</button>
                <a href="{{ route('sacrements.examens.index') }}" class="btn btn-outline-secondary ms-1">Réinitialiser</a>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead style="background:#1A3A6B;color:#fff">
                <tr><th>Titre</th><th>Niveau</th><th>Type</th><th>Date</th><th>Note max.</th><th>Note passage</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($examens as $examen)
                <tr>
                    <td class="fw-semibold">{{ $examen->titre }}</td>
                    <td><span class="badge" style="background:#1A3A6B">{{ $examen->niveauFormation->nom ?? '—' }}</span></td>
                    <td>{{ $examen->type_label }}</td>
                    <td>{{ $examen->date_examen ? $examen->date_examen->format('d/m/Y') : '—' }}</td>
                    <td>{{ $examen->note_maximale }}</td>
                    <td>{{ $examen->note_passage }}</td>
                    <td class="text-end">
                        <a href="{{ route('sacrements.examens.show', $examen) }}" class="btn btn-sm btn-outline-primary" title="Voir"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('sacrements.examens.saisir-resultats', $examen) }}" class="btn btn-sm btn-outline-success" title="Saisir notes"><i class="bi bi-clipboard-check"></i></a>
                        <a href="{{ route('sacrements.examens.edit', $examen) }}" class="btn btn-sm btn-outline-warning" title="Modifier"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('sacrements.examens.destroy', $examen) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer cet examen ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Aucun examen trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($examens->hasPages())<div class="card-footer">{{ $examens->links() }}</div>@endif
</div>
@endsection
