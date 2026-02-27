@extends('sacrements.layouts.sacrements')
@section('title', 'Saisir les notes')
@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.examens.index') }}" style="color:#1A3A6B">Examens</a></li>
    <li class="breadcrumb-item"><a href="{{ route('sacrements.examens.show', $examen) }}" style="color:#1A3A6B">{{ $examen->titre }}</a></li>
    <li class="breadcrumb-item active">Saisir les notes</li>
</ol></nav>
<div class="card">
    <div class="card-header fw-bold" style="background:#1A3A6B;color:#fff">
        <i class="bi bi-clipboard-check me-2"></i>Saisie des notes — {{ $examen->titre }}
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-1"></i>
            Note maximale : <strong>{{ $examen->note_maximale }}</strong> |
            Note de passage : <strong>{{ $examen->note_passage }}</strong> |
            Type : <strong>{{ $examen->type_label }}</strong>
        </div>
        <form action="{{ route('sacrements.examens.enregistrer-resultats', $examen) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Date de l'examen <span class="text-danger">*</span></label>
                <input type="date" name="date_examen" class="form-control" style="max-width:250px"
                       value="{{ $examen->date_examen?->format('Y-m-d') ?? date('Y-m-d') }}" required>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead style="background:#F0F4FF">
                        <tr>
                            <th>#</th>
                            <th>Catéchumène</th>
                            <th>N° Dossier</th>
                            <th style="width:150px">Note (/{{ $examen->note_maximale }})</th>
                            <th>Observations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($catechumenes as $i => $cat)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="fw-semibold">{{ $cat->nom_complet }}</td>
                            <td class="text-muted small">{{ $cat->numero_dossier }}</td>
                            <td>
                                <input type="number" name="notes[{{ $cat->id }}]"
                                       class="form-control form-control-sm note-input"
                                       min="0" max="{{ $examen->note_maximale }}" step="0.5"
                                       value="{{ $resultatsExistants[$cat->id] ?? '' }}"
                                       placeholder="—"
                                       data-passage="{{ $examen->note_passage }}">
                            </td>
                            <td>
                                <input type="text" name="observations[{{ $cat->id }}]"
                                       class="form-control form-control-sm"
                                       placeholder="Observation...">
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted">Aucun catéchumène trouvé pour ce niveau.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary-custom"><i class="bi bi-check-circle me-1"></i>Enregistrer les notes</button>
                <a href="{{ route('sacrements.examens.show', $examen) }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.querySelectorAll('.note-input').forEach(function(input) {
    input.addEventListener('input', function() {
        const note = parseFloat(this.value);
        const passage = parseFloat(this.dataset.passage);
        if (!isNaN(note)) {
            this.style.borderColor = note >= passage ? '#198754' : '#dc3545';
            this.style.borderWidth = '2px';
        } else {
            this.style.borderColor = '';
        }
    });
});
</script>
@endsection
