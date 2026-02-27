@extends('sacrements.layouts.sacrements')
@section('title', 'Progression — ' . $catechumene->nom_complet)

@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.catechumenes.index') }}" style="color:#1A3A6B">Catéchumènes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('sacrements.catechumenes.show', $catechumene) }}" style="color:#1A3A6B">{{ $catechumene->nom_complet }}</a></li>
    <li class="breadcrumb-item active">Progression</li>
</ol></nav>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0" style="color:#1A3A6B">
            <i class="bi bi-bar-chart-steps me-2"></i>Suivi de progression
        </h2>
        <p class="text-muted mb-0">{{ $catechumene->nom_complet }} — {{ $catechumene->numero_dossier }}</p>
    </div>
    <a href="{{ route('sacrements.catechumenes.show', $catechumene) }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Retour au dossier
    </a>
</div>

@php $progressionsMap = $catechumene->progressions->keyBy('niveau_formation_id'); @endphp

<div class="row g-4">
    @foreach($niveaux as $niveau)
    @php $prog = $progressionsMap->get($niveau->id); @endphp
    <div class="col-md-6">
        <div class="card h-100" style="border-left:4px solid {{ $prog && $prog->valide ? '#198754' : ($prog ? '#1A3A6B' : '#dee2e6') }}">
            <div class="card-header d-flex justify-content-between align-items-center"
                 style="background:{{ $prog ? '#F0F4FF' : '#f8f9fa' }}">
                <div class="fw-bold" style="color:#1A3A6B">
                    <span class="badge me-2" style="background:#1A3A6B">{{ $niveau->ordre }}</span>
                    {{ $niveau->nom }}
                </div>
                @if($prog)
                <span class="badge {{ $prog->statut=='termine'?'bg-success':($prog->statut=='en_cours'?'bg-primary':'bg-secondary') }}">
                    {{ $prog->statut_label }}
                </span>
                @else
                <span class="badge bg-light text-muted border">Non commencé</span>
                @endif
            </div>
            <div class="card-body">
                @if($prog)
                <dl class="row mb-3">
                    <dt class="col-sm-5">Date de début</dt>
                    <dd class="col-sm-7">{{ $prog->date_debut?->format('d/m/Y') }}</dd>

                    <dt class="col-sm-5">Date de fin</dt>
                    <dd class="col-sm-7">{{ $prog->date_fin?->format('d/m/Y') ?? '—' }}</dd>

                    <dt class="col-sm-5">Note finale</dt>
                    <dd class="col-sm-7">{{ $prog->note_finale !== null ? $prog->note_finale.'/20' : '—' }}</dd>

                    <dt class="col-sm-5">Validé</dt>
                    <dd class="col-sm-7">
                        @if($prog->valide)
                        <span class="badge bg-success">
                            <i class="bi bi-check-circle me-1"></i>Oui — {{ $prog->date_validation?->format('d/m/Y') }}
                        </span>
                        @else
                        <span class="text-muted">Non validé</span>
                        @endif
                    </dd>

                    @if($prog->validePar)
                    <dt class="col-sm-5">Validé par</dt>
                    <dd class="col-sm-7">{{ $prog->validePar->name }}</dd>
                    @endif

                    @if($prog->commentaires)
                    <dt class="col-sm-5">Commentaires</dt>
                    <dd class="col-sm-7 text-muted small">{{ $prog->commentaires }}</dd>
                    @endif
                </dl>

                {{-- Formulaire mise à jour --}}
                <form action="{{ route('sacrements.progressions.update', $prog) }}" method="POST" class="border-top pt-3">
                    @csrf @method('PUT')
                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label small fw-semibold">Statut</label>
                            <select name="statut" class="form-select form-select-sm">
                                @foreach(['en_cours'=>'En cours','termine'=>'Terminé','abandonne'=>'Abandonné','en_attente'=>'En attente'] as $k=>$v)
                                <option value="{{ $k }}" {{ $prog->statut==$k?'selected':'' }}>{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold">Note finale</label>
                            <input type="number" name="note_finale" class="form-control form-control-sm"
                                   value="{{ $prog->note_finale }}" min="0" max="20" step="0.5">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold">Date de fin</label>
                            <input type="date" name="date_fin" class="form-control form-control-sm"
                                   value="{{ $prog->date_fin?->format('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-sm btn-primary-custom">
                            <i class="bi bi-save me-1"></i>Mettre à jour
                        </button>
                        @if(!$prog->valide)
                        <form action="{{ route('sacrements.progressions.valider', $prog) }}" method="POST"
                              onsubmit="return confirm('Valider ce niveau ?')">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-outline-success">
                                <i class="bi bi-check-circle me-1"></i>Valider
                            </button>
                        </form>
                        @endif
                    </div>
                </form>

                @else
                {{-- Formulaire inscription au niveau --}}
                <p class="text-muted small mb-3">Ce catéchumène n'est pas encore inscrit à ce niveau.</p>
                <form action="{{ route('sacrements.progressions.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="catechumene_id" value="{{ $catechumene->id }}">
                    <input type="hidden" name="niveau_formation_id" value="{{ $niveau->id }}">
                    <div class="mb-2">
                        <label class="form-label small fw-semibold">Date de début</label>
                        <input type="date" name="date_debut" class="form-control form-control-sm"
                               value="{{ date('Y-m-d') }}" required>
                    </div>
                    <button type="submit" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-plus me-1"></i>Inscrire à ce niveau
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
