@extends('sacrements.layouts.sacrements')
@section('title', 'Dossier — ' . $catechumene->nom_complet)

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('sacrements.dashboard') }}" style="color:#1A3A6B">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('sacrements.catechumenes.index') }}" style="color:#1A3A6B">Catéchumènes</a></li>
        <li class="breadcrumb-item active">{{ $catechumene->nom_complet }}</li>
    </ol>
</nav>

{{-- ═══ EN-TÊTE DU DOSSIER ═══ --}}
<div class="card mb-4" style="border-left:5px solid #1A3A6B">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-auto">
                @if($catechumene->photo)
                <img src="{{ Storage::url($catechumene->photo) }}" alt="Photo"
                     class="rounded-circle" style="width:90px;height:90px;object-fit:cover;border:4px solid #1A3A6B">
                @else
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:90px;height:90px;background:#e8f0fb;border:4px solid #1A3A6B;font-size:2rem;color:#1A3A6B;font-weight:bold">
                    {{ strtoupper(substr($catechumene->prenom,0,1) . substr($catechumene->nom,0,1)) }}
                </div>
                @endif
            </div>
            <div class="col">
                <h2 class="fw-bold mb-1" style="color:#1A3A6B">{{ $catechumene->nom_complet }}</h2>
                <div class="d-flex flex-wrap gap-2 align-items-center mb-1">
                    <span class="badge bg-light text-dark border font-monospace">{{ $catechumene->numero_dossier }}</span>
                    <span class="badge bg-{{ $catechumene->statut_color }} fs-6">{{ $catechumene->statut_label }}</span>
                    @if($catechumene->groupeCatechese)
                    <span class="badge" style="background:#1A3A6B">
                        <i class="bi bi-collection me-1"></i>{{ $catechumene->groupeCatechese->nom }}
                    </span>
                    @endif
                </div>
                <div class="text-muted small">
                    <i class="bi bi-calendar me-1"></i>Inscrit le {{ $catechumene->date_inscription?->format('d/m/Y') }}
                    &nbsp;|&nbsp;
                    <i class="bi bi-person me-1"></i>{{ $catechumene->sexe == 'M' ? 'Masculin' : 'Féminin' }}
                    &nbsp;|&nbsp;
                    <i class="bi bi-clock me-1"></i>{{ $catechumene->age }} ans
                </div>
            </div>
            <div class="col-auto d-flex flex-column gap-2">
                <a href="{{ route('sacrements.catechumenes.edit', $catechumene) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil me-1"></i>Modifier
                </a>
                <a href="{{ route('sacrements.catechumenes.progression', $catechumene) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-bar-chart-steps me-1"></i>Progression
                </a>
                <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i>Imprimer
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ═══ CHANGER STATUT ═══ --}}
<div class="card mb-4">
    <div class="card-body py-2">
        <form action="{{ route('sacrements.catechumenes.changer-statut', $catechumene) }}" method="POST"
              class="d-flex align-items-center gap-3">
            @csrf @method('PATCH')
            <label class="fw-semibold small mb-0" style="color:#1A3A6B">Changer le statut :</label>
            <select name="statut" class="form-select form-select-sm" style="width:auto">
                @foreach(['inscrit'=>'Inscrit','en_cours'=>'En cours','suspendu'=>'Suspendu','diplome'=>'Diplômé','abandonne'=>'Abandonné'] as $k=>$v)
                <option value="{{ $k }}" {{ $catechumene->statut==$k?'selected':'' }}>{{ $v }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-sm btn-primary-custom"
                    onclick="return confirm('Confirmer le changement de statut ?')">
                <i class="bi bi-check me-1"></i>Appliquer
            </button>
        </form>
    </div>
</div>

{{-- ═══ ONGLETS PRINCIPAUX ═══ --}}
<ul class="nav nav-tabs mb-3" id="dossierTabs">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#infos-tab">
            <i class="bi bi-person-lines-fill me-1"></i>Infos personnelles
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#parents-tab">
            <i class="bi bi-people me-1"></i>Parents/Tuteurs
            <span class="badge bg-secondary ms-1">{{ $catechumene->parentsTuteurs->count() }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#progression-tab">
            <i class="bi bi-bar-chart-steps me-1"></i>Progression
            <span class="badge bg-secondary ms-1">{{ $catechumene->progressions->count() }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#examens-tab">
            <i class="bi bi-pencil-square me-1"></i>Examens
            <span class="badge bg-secondary ms-1">{{ $catechumene->resultatsExamens->count() }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#sacrements-tab">
            <i class="bi bi-cross me-1"></i>Sacrements
            <span class="badge bg-secondary ms-1">{{ $catechumene->sacrements->count() }}</span>
        </a>
    </li>
</ul>

<div class="tab-content">

    {{-- ─── Onglet 1 : Infos personnelles ─── --}}
    <div class="tab-pane fade show active" id="infos-tab">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3" style="color:#1A3A6B">État civil</h6>
                        <dl class="row mb-4">
                            <dt class="col-sm-5">Nom complet</dt>
                            <dd class="col-sm-7">{{ $catechumene->nom_complet }}</dd>

                            <dt class="col-sm-5">Date de naissance</dt>
                            <dd class="col-sm-7">{{ $catechumene->date_naissance?->format('d/m/Y') ?? '—' }}</dd>

                            <dt class="col-sm-5">Lieu de naissance</dt>
                            <dd class="col-sm-7">{{ $catechumene->lieu_naissance ?? '—' }}</dd>

                            <dt class="col-sm-5">Âge</dt>
                            <dd class="col-sm-7">{{ $catechumene->age }} ans</dd>

                            <dt class="col-sm-5">Sexe</dt>
                            <dd class="col-sm-7">{{ $catechumene->sexe == 'M' ? '♂ Masculin' : '♀ Féminin' }}</dd>

                            <dt class="col-sm-5">Nationalité</dt>
                            <dd class="col-sm-7">{{ $catechumene->nationalite ?? '—' }}</dd>

                            <dt class="col-sm-5">Statut matrimonial</dt>
                            <dd class="col-sm-7">
                                @php $sm = ['celibataire'=>'Célibataire','marie'=>'Marié(e)','divorce'=>'Divorcé(e)','veuf'=>'Veuf/Veuve']; @endphp
                                {{ $sm[$catechumene->statut_matrimonial] ?? '—' }}
                            </dd>

                            <dt class="col-sm-5">Profession</dt>
                            <dd class="col-sm-7">{{ $catechumene->profession ?? '—' }}</dd>

                            <dt class="col-sm-5">Religion actuelle</dt>
                            <dd class="col-sm-7">{{ $catechumene->religion_actuelle ?? '—' }}</dd>
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3" style="color:#1A3A6B">Coordonnées</h6>
                        <dl class="row mb-4">
                            <dt class="col-sm-5">Téléphone</dt>
                            <dd class="col-sm-7">{{ $catechumene->telephone ?? '—' }}</dd>

                            <dt class="col-sm-5">Email</dt>
                            <dd class="col-sm-7">{{ $catechumene->email ?? '—' }}</dd>

                            <dt class="col-sm-5">Adresse</dt>
                            <dd class="col-sm-7">{{ $catechumene->adresse ?? '—' }}</dd>
                        </dl>

                        <h6 class="fw-bold mb-3" style="color:#1A3A6B">Catéchèse</h6>
                        <dl class="row mb-0">
                            <dt class="col-sm-5">N° Dossier</dt>
                            <dd class="col-sm-7 font-monospace">{{ $catechumene->numero_dossier }}</dd>

                            <dt class="col-sm-5">Date d'inscription</dt>
                            <dd class="col-sm-7">{{ $catechumene->date_inscription?->format('d/m/Y') ?? '—' }}</dd>

                            <dt class="col-sm-5">Groupe</dt>
                            <dd class="col-sm-7">{{ $catechumene->groupeCatechese?->nom ?? '—' }}</dd>

                            <dt class="col-sm-5">Niveau actuel</dt>
                            <dd class="col-sm-7">{{ $catechumene->groupeCatechese?->niveauFormation?->nom ?? '—' }}</dd>
                        </dl>
                    </div>
                    @if($catechumene->observations)
                    <div class="col-12 mt-3">
                        <h6 class="fw-bold" style="color:#1A3A6B">Observations</h6>
                        <div class="bg-light rounded p-3">{{ $catechumene->observations }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ─── Onglet 2 : Parents/Tuteurs ─── --}}
    <div class="tab-pane fade" id="parents-tab">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center" style="background:#1A3A6B;color:#fff">
                <span><i class="bi bi-people me-2"></i>Parents et Tuteurs</span>
                <button class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#addParentModal">
                    <i class="bi bi-plus me-1"></i>Ajouter
                </button>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead style="background:#F0F4FF">
                        <tr><th>Nom complet</th><th>Lien</th><th>Téléphone</th><th>Email</th><th>Profession</th></tr>
                    </thead>
                    <tbody>
                        @forelse($catechumene->parentsTuteurs as $parent)
                        <tr>
                            <td class="fw-semibold">{{ $parent->nom_complet }}</td>
                            <td><span class="badge bg-secondary">{{ $parent->lien_label }}</span></td>
                            <td>{{ $parent->telephone ?? '—' }}</td>
                            <td>{{ $parent->email ?? '—' }}</td>
                            <td>{{ $parent->profession ?? '—' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Aucun parent/tuteur enregistré.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modal ajout parent --}}
        <div class="modal fade" id="addParentModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background:#1A3A6B;color:#fff">
                        <h5 class="modal-title">Ajouter un parent/tuteur</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('sacrements.catechumenes.index') }}" method="POST">
                        @csrf
                        <input type="hidden" name="catechumene_id" value="{{ $catechumene->id }}">
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label fw-semibold">Nom *</label>
                                    <input type="text" name="nom" class="form-control" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label fw-semibold">Prénom *</label>
                                    <input type="text" name="prenom" class="form-control" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label fw-semibold">Lien *</label>
                                    <select name="lien" class="form-select" required>
                                        <option value="pere">Père</option>
                                        <option value="mere">Mère</option>
                                        <option value="tuteur">Tuteur</option>
                                        <option value="autre">Autre</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label fw-semibold">Téléphone</label>
                                    <input type="text" name="telephone" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="col-6">
                                    <label class="form-label fw-semibold">Profession</label>
                                    <input type="text" name="profession" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary-custom">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ─── Onglet 3 : Progression pédagogique ─── --}}
    <div class="tab-pane fade" id="progression-tab">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center" style="background:#1A3A6B;color:#fff">
                <span><i class="bi bi-bar-chart-steps me-2"></i>Parcours pédagogique</span>
                <button class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#addProgressionModal">
                    <i class="bi bi-plus me-1"></i>Inscrire à un niveau
                </button>
            </div>
            <div class="card-body">
                @php $niveauxProgression = $catechumene->progressions->keyBy('niveau_formation_id'); @endphp

                @forelse($niveaux as $niveau)
                @php $prog = $niveauxProgression->get($niveau->id); @endphp
                <div class="d-flex align-items-center gap-3 mb-3 p-3 rounded"
                     style="background:{{ $prog ? '#f0f8f0' : '#f8f9fa' }};border-left:4px solid {{ $prog && $prog->valide ? '#198754' : ($prog ? '#1A3A6B' : '#dee2e6') }}">
                    <div class="d-flex align-items-center justify-content-center rounded-circle"
                         style="width:42px;height:42px;min-width:42px;background:{{ $prog && $prog->valide ? '#198754' : ($prog ? '#1A3A6B' : '#adb5bd') }};color:#fff;font-weight:bold">
                        {{ $niveau->ordre }}
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-bold">{{ $niveau->nom }}</div>
                        @if($prog)
                        <div class="text-muted small">
                            Début : {{ $prog->date_debut?->format('d/m/Y') }}
                            @if($prog->date_fin) | Fin : {{ $prog->date_fin->format('d/m/Y') }} @endif
                            @if($prog->note_finale !== null) | Note : <strong>{{ $prog->note_finale }}/20</strong> @endif
                        </div>
                        @else
                        <div class="text-muted small">Non commencé</div>
                        @endif
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        @if($prog)
                        <span class="badge {{ $prog->statut=='termine'?'bg-success':($prog->statut=='en_cours'?'bg-primary':'bg-secondary') }}">
                            {{ $prog->statut_label }}
                        </span>
                        @if($prog->valide)
                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Validé</span>
                        @else
                        <form action="{{ route('sacrements.progressions.valider', $prog) }}" method="POST"
                              onsubmit="return confirm('Valider ce niveau pour ce catéchumène ?')">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-outline-success">
                                <i class="bi bi-check2 me-1"></i>Valider
                            </button>
                        </form>
                        @endif
                        @else
                        <span class="text-muted small">—</span>
                        @endif
                    </div>
                </div>
                @empty
                <p class="text-muted">Aucun niveau de formation configuré.</p>
                @endforelse
            </div>
        </div>

        {{-- Modal inscrire au niveau --}}
        <div class="modal fade" id="addProgressionModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background:#1A3A6B;color:#fff">
                        <h5 class="modal-title">Inscrire à un niveau</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('sacrements.progressions.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="catechumene_id" value="{{ $catechumene->id }}">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Niveau *</label>
                                <select name="niveau_formation_id" class="form-select" required>
                                    @foreach($niveaux as $n)
                                    <option value="{{ $n->id }}">{{ $n->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Date de début *</label>
                                <input type="date" name="date_debut" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Commentaires</label>
                                <textarea name="commentaires" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary-custom">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ─── Onglet 4 : Résultats d'examens ─── --}}
    <div class="tab-pane fade" id="examens-tab">
        <div class="card">
            <div class="card-header" style="background:#1A3A6B;color:#fff">
                <i class="bi bi-pencil-square me-2"></i>Résultats d'examens
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead style="background:#F0F4FF">
                        <tr><th>Examen</th><th>Niveau</th><th>Note</th><th>Mention</th><th>Statut</th><th>Date</th><th>Observations</th></tr>
                    </thead>
                    <tbody>
                        @forelse($catechumene->resultatsExamens as $resultat)
                        <tr>
                            <td class="fw-semibold">{{ $resultat->examen->titre ?? '—' }}</td>
                            <td>
                                <span class="badge" style="background:#1A3A6B;font-size:.75rem">
                                    {{ $resultat->examen->niveauFormation->nom ?? '—' }}
                                </span>
                            </td>
                            <td class="fw-bold">
                                {{ $resultat->note_obtenue }}/{{ $resultat->examen->note_maximale ?? 20 }}
                            </td>
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
                            <td class="small">{{ $resultat->date_examen?->format('d/m/Y') }}</td>
                            <td class="text-muted small">{{ $resultat->observations ?? '—' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Aucun résultat d'examen enregistré.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ─── Onglet 5 : Sacrements reçus ─── --}}
    <div class="tab-pane fade" id="sacrements-tab">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center" style="background:#1A3A6B;color:#fff">
                <span><i class="bi bi-cross me-2"></i>Sacrements reçus</span>
                <a href="{{ route('sacrements.sacrements.create', $catechumene) }}" class="btn btn-sm btn-outline-light">
                    <i class="bi bi-plus me-1"></i>Ajouter
                </a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead style="background:#F0F4FF">
                        <tr><th>Sacrement</th><th>Date</th><th>Lieu</th><th>Prêtre officiant</th><th>Parrain</th><th>Marraine</th><th>N° Registre</th><th></th></tr>
                    </thead>
                    <tbody>
                        @forelse($catechumene->sacrements as $sacrement)
                        <tr>
                            <td>
                                <span class="badge" style="background:#C0392B">{{ $sacrement->type_label }}</span>
                            </td>
                            <td class="small">{{ $sacrement->date_sacrement?->format('d/m/Y') }}</td>
                            <td>{{ $sacrement->lieu_sacrement ?? '—' }}</td>
                            <td>{{ $sacrement->pretre_officiant ?? '—' }}</td>
                            <td>{{ $sacrement->parrain ?? '—' }}</td>
                            <td>{{ $sacrement->marraine ?? '—' }}</td>
                            <td class="font-monospace small">{{ $sacrement->numero_registre ?? '—' }}</td>
                            <td>
                                <a href="{{ route('sacrements.sacrements.edit', $sacrement) }}"
                                   class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('sacrements.sacrements.destroy', $sacrement) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Supprimer ce sacrement ?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                Aucun sacrement enregistré.
                                <a href="{{ route('sacrements.sacrements.create', $catechumene) }}" style="color:#1A3A6B">
                                    Ajouter le premier sacrement
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>{{-- end tab-content --}}

{{-- Bouton retour --}}
<div class="mt-4">
    <a href="{{ route('sacrements.catechumenes.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Retour à la liste
    </a>
</div>

@endsection
