@extends('sacrements.layouts.sacrements')
@section('title', 'Tableau de bord — Sacrements')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0" style="color:#1A3A6B">
            <i class="bi bi-speedometer2 me-2"></i>Tableau de bord
        </h2>
        <p class="text-muted small mb-0" style="color: rgba(228, 146, 23, 0.98) ">Paroisse Saint-Esprit de Bépanda — Module Sacrements</p>
    </div>
    <a href="{{ route('sacrements.catechumenes.create') }}" class="btn btn-primary-custom">
        <i class="bi bi-plus-circle me-1"></i> Nouveau Catéchumène
    </a>
</div>

{{-- Stats Cards --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card stat-card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                         style="width:48px;height:48px;background:#e8f0fb">
                        <i class="bi bi-people-fill fs-4" style="color:#1A3A6B"></i>
                    </div>
                    <div>
                        <div class="fs-2 fw-bold" style="color:#1A3A6B">{{ $stats['total_catechumenes'] }}</div>
                        <div class="text-muted small">Total catéchumènes</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card accent h-100">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                         style="width:48px;height:48px;background:#fdecea">
                        <i class="bi bi-person-check-fill fs-4" style="color:#C0392B"></i>
                    </div>
                    <div>
                        <div class="fs-2 fw-bold" style="color:#C0392B">{{ $stats['en_cours'] }}</div>
                        <div class="text-muted small">En cours</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card h-100" style="border-left-color:#198754">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                         style="width:48px;height:48px;background:#e8f5e9">
                        <i class="bi bi-collection fs-4" style="color:#198754"></i>
                    </div>
                    <div>
                        <div class="fs-2 fw-bold" style="color:#198754">{{ $stats['groupes_actifs'] }}</div>
                        <div class="text-muted small">Groupes actifs</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card h-100" style="border-left-color:#6f42c1">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                         style="width:48px;height:48px;background:#f3eeff">
                        <i class="bi bi-award-fill fs-4" style="color:#6f42c1"></i>
                    </div>
                    <div>
                        <div class="fs-2 fw-bold" style="color:#6f42c1">{{ $stats['diplome'] }}</div>
                        <div class="text-muted small">Diplômés</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Statut breakdown --}}
<div class="row g-3 mb-4">
    <div class="col-md-8">
        <div class="card h-100">
            <div class="card-header fw-semibold" style="background:#1A3A6B;color:#fff">
                <i class="bi bi-bar-chart me-2"></i>Répartition par statut
            </div>
            <div class="card-body">
                @php $total = $stats['total_catechumenes'] ?: 1; @endphp
                @foreach([
                    ['label'=>'Inscrits','key'=>'inscrit','color'=>'primary','val'=>$stats['inscrit']],
                    ['label'=>'En cours','key'=>'en_cours','color'=>'success','val'=>$stats['en_cours']],
                    ['label'=>'Suspendus','key'=>'suspendu','color'=>'warning','val'=>$stats['total_catechumenes']-$stats['inscrit']-$stats['en_cours']-$stats['diplome']-$stats['abandonne']],
                    ['label'=>'Diplômés','key'=>'diplome','color'=>'info','val'=>$stats['diplome']],
                    ['label'=>'Abandonnés','key'=>'abandonne','color'=>'danger','val'=>$stats['abandonne']],
                ] as $item)
                <div class="mb-3">
                    <div class="d-flex justify-content-between small mb-1">
                        <span>{{ $item['label'] }}</span>
                        <span class="fw-bold">{{ $item['val'] }}</span>
                    </div>
                    <div class="progress" style="height:10px">
                        <div class="progress-bar bg-{{ $item['color'] }}" style="width:{{ round(($item['val']/$total)*100) }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header fw-semibold" style="background:#1A3A6B;color:#fff">
                <i class="bi bi-layers me-2"></i>Niveaux de formation
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($niveaux as $niveau)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="small">{{ $niveau->nom }}</span>
                        <span class="badge rounded-pill" style="background:#1A3A6B">
                            {{ $niveau->progressions_count }}
                        </span>
                    </li>
                    @empty
                    <li class="list-group-item text-muted small">Aucun niveau configuré</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- Recent activity --}}
<div class="row g-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header fw-semibold" style="background:#1A3A6B;color:#fff">
                <i class="bi bi-clock-history me-2"></i>Derniers catéchumènes inscrits
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($catechumenes_recents as $c)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('sacrements.catechumenes.show', $c) }}"
                               class="text-decoration-none fw-semibold" style="color:#1A3A6B">
                                {{ $c->nom_complet }}
                            </a>
                            <div class="text-muted small">{{ $c->numero_dossier }}</div>
                        </div>
                        <span class="badge bg-{{ $c->statut_color }}">{{ $c->statut_label }}</span>
                    </li>
                    @empty
                    <li class="list-group-item text-muted small">Aucun catéchumène enregistré</li>
                    @endforelse
                </ul>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('sacrements.catechumenes.index') }}" class="small" style="color:#1A3A6B">
                    Voir tous <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header fw-semibold" style="background:#1A3A6B;color:#fff">
                <i class="bi bi-pencil-square me-2"></i>Examens récents
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($examens_recents as $examen)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('sacrements.examens.show', $examen) }}"
                               class="text-decoration-none fw-semibold" style="color:#1A3A6B">
                                {{ $examen->titre }}
                            </a>
                            <div class="text-muted small">{{ $examen->niveauFormation->nom ?? '—' }}</div>
                        </div>
                        @if($examen->date_examen)
                        <span class="badge bg-secondary small">{{ $examen->date_examen->format('d/m/Y') }}</span>
                        @endif
                    </li>
                    @empty
                    <li class="list-group-item text-muted small">Aucun examen enregistré</li>
                    @endforelse
                </ul>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('sacrements.examens.index') }}" class="small" style="color:#1A3A6B">
                    Voir tous <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
