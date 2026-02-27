@extends('sacrements.layouts.sacrements')
@section('title', $niveau->nom)

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('sacrements.dashboard') }}" style="color:#1A3A6B">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('sacrements.niveaux.index') }}" style="color:#1A3A6B">Niveaux</a></li>
        <li class="breadcrumb-item active">{{ $niveau->nom }}</li>
    </ol>
</nav>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0" style="color:#1A3A6B">{{ $niveau->nom }}</h2>
        <span class="badge {{ $niveau->actif ? 'bg-success' : 'bg-secondary' }}">
            {{ $niveau->actif ? 'Actif' : 'Inactif' }}
        </span>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('sacrements.niveaux.edit', $niveau) }}" class="btn btn-warning">
            <i class="bi bi-pencil me-1"></i>Modifier
        </a>
        <a href="{{ route('sacrements.niveaux.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Retour
        </a>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="fs-3 fw-bold" style="color:#1A3A6B">{{ $niveau->ordre }}</div>
                <div class="text-muted small">Ordre dans le parcours</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="fs-3 fw-bold" style="color:#1A3A6B">{{ $niveau->duree_mois }}</div>
                <div class="text-muted small">Durée (mois)</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="fs-3 fw-bold" style="color:#1A3A6B">{{ $niveau->age_minimum ?? '—' }}</div>
                <div class="text-muted small">Âge minimum</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="fs-3 fw-bold" style="color:#1A3A6B">{{ $niveau->cours->count() }}</div>
                <div class="text-muted small">Cours</div>
            </div>
        </div>
    </div>
</div>

@if($niveau->description)
<div class="card mb-4">
    <div class="card-body">
        <h6 class="fw-bold" style="color:#1A3A6B">Description</h6>
        <p class="mb-0">{{ $niveau->description }}</p>
    </div>
</div>
@endif

<ul class="nav nav-tabs mb-3" id="niveauTabs">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#cours-tab">
            <i class="bi bi-book me-1"></i>Cours ({{ $niveau->cours->count() }})
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#examens-tab">
            <i class="bi bi-pencil-square me-1"></i>Examens ({{ $niveau->examens->count() }})
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#groupes-tab">
            <i class="bi bi-collection me-1"></i>Groupes ({{ $niveau->groupesCatechese->count() }})
        </a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade show active" id="cours-tab">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead style="background:#F0F4FF">
                        <tr>
                            <th>N°</th><th>Titre</th><th>Durée</th><th>Statut</th><th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($niveau->cours as $cours)
                        <tr>
                            <td>{{ $cours->ordre }}</td>
                            <td>
                                <div class="fw-semibold">{{ $cours->titre }}</div>
                                @if($cours->objectifs)
                                <div class="text-muted small">{{ Str::limit($cours->objectifs, 60) }}</div>
                                @endif
                            </td>
                            <td>{{ $cours->duree_heures ? $cours->duree_heures . 'h' : '—' }}</td>
                            <td><span class="badge {{ $cours->actif ? 'bg-success' : 'bg-secondary' }}">{{ $cours->actif ? 'Actif' : 'Inactif' }}</span></td>
                            <td>
                                <a href="{{ route('sacrements.cours.edit', $cours) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted">Aucun cours pour ce niveau.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="examens-tab">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead style="background:#F0F4FF">
                        <tr><th>Titre</th><th>Type</th><th>Date</th><th>Note max.</th><th></th></tr>
                    </thead>
                    <tbody>
                        @forelse($niveau->examens as $examen)
                        <tr>
                            <td>{{ $examen->titre }}</td>
                            <td>{{ $examen->type_label }}</td>
                            <td>{{ $examen->date_examen ? $examen->date_examen->format('d/m/Y') : '—' }}</td>
                            <td>{{ $examen->note_maximale }}</td>
                            <td>
                                <a href="{{ route('sacrements.examens.show', $examen) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted">Aucun examen pour ce niveau.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="groupes-tab">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead style="background:#F0F4FF">
                        <tr><th>Nom</th><th>Année pastorale</th><th>Jour</th><th>Heure</th><th></th></tr>
                    </thead>
                    <tbody>
                        @forelse($niveau->groupesCatechese as $groupe)
                        <tr>
                            <td>{{ $groupe->nom }}</td>
                            <td>{{ $groupe->annee_pastorale }}</td>
                            <td>{{ ucfirst($groupe->jour_reunion ?? '—') }}</td>
                            <td>{{ $groupe->heure_reunion ?? '—' }}</td>
                            <td>
                                <a href="{{ route('sacrements.groupes.show', $groupe) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted">Aucun groupe pour ce niveau.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
