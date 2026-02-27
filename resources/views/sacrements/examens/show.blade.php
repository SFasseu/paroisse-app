@extends('sacrements.layouts.sacrements')
@section('title', $examen->titre)
@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.examens.index') }}" style="color:#1A3A6B">Examens</a></li>
    <li class="breadcrumb-item active">{{ $examen->titre }}</li>
</ol></nav>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0" style="color:#1A3A6B">{{ $examen->titre }}</h2>
        <span class="badge" style="background:#1A3A6B">{{ $examen->niveauFormation->nom ?? '—' }}</span>
        <span class="badge bg-secondary ms-1">{{ $examen->type_label }}</span>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('sacrements.examens.saisir-resultats', $examen) }}" class="btn btn-success">
            <i class="bi bi-clipboard-check me-1"></i>Saisir les notes
        </a>
        <a href="{{ route('sacrements.examens.edit', $examen) }}" class="btn btn-warning">
            <i class="bi bi-pencil me-1"></i>Modifier
        </a>
        <a href="{{ route('sacrements.examens.index') }}" class="btn btn-outline-secondary">Retour</a>
    </div>
</div>
<div class="row g-3 mb-4">
    <div class="col-md-3"><div class="card text-center"><div class="card-body">
        <div class="fs-3 fw-bold" style="color:#1A3A6B">{{ $examen->note_maximale }}</div>
        <div class="text-muted small">Note maximale</div>
    </div></div></div>
    <div class="col-md-3"><div class="card text-center"><div class="card-body">
        <div class="fs-3 fw-bold" style="color:#C0392B">{{ $examen->note_passage }}</div>
        <div class="text-muted small">Note de passage</div>
    </div></div></div>
    <div class="col-md-3"><div class="card text-center"><div class="card-body">
        <div class="fs-3 fw-bold" style="color:#198754">{{ $examen->resultats->where('statut','reussi')->count() }}</div>
        <div class="text-muted small">Réussis</div>
    </div></div></div>
    <div class="col-md-3"><div class="card text-center"><div class="card-body">
        <div class="fs-3 fw-bold" style="color:#dc3545">{{ $examen->resultats->where('statut','echoue')->count() }}</div>
        <div class="text-muted small">Échecs</div>
    </div></div></div>
</div>
<div class="card">
    <div class="card-header fw-semibold" style="background:#1A3A6B;color:#fff">
        <i class="bi bi-table me-2"></i>Résultats des catéchumènes ({{ $examen->resultats->count() }})
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead style="background:#F0F4FF">
                <tr><th>Catéchumène</th><th>Note</th><th>Mention</th><th>Statut</th><th>Date</th><th>Observations</th></tr>
            </thead>
            <tbody>
                @forelse($examen->resultats as $resultat)
                <tr>
                    <td>
                        <a href="{{ route('sacrements.catechumenes.show', $resultat->catechumene) }}"
                           style="color:#1A3A6B;text-decoration:none;font-weight:600">
                            {{ $resultat->catechumene->nom_complet }}
                        </a>
                        <div class="text-muted small">{{ $resultat->catechumene->numero_dossier }}</div>
                    </td>
                    <td class="fw-bold">{{ $resultat->note_obtenue }}/{{ $examen->note_maximale }}</td>
                    <td>{{ $resultat->mention }}</td>
                    <td>
                        @if($resultat->statut == 'reussi')
                            <span class="badge bg-success">Réussi</span>
                        @elseif($resultat->statut == 'echoue')
                            <span class="badge bg-danger">Échoué</span>
                        @else
                            <span class="badge bg-secondary">Absent</span>
                        @endif
                    </td>
                    <td>{{ $resultat->date_examen->format('d/m/Y') }}</td>
                    <td class="text-muted small">{{ $resultat->observations ?? '—' }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Aucun résultat enregistré.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
