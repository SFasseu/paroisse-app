@extends('sacrements.layouts.sacrements')
@section('title', 'Modifier le dossier')
@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.catechumenes.index') }}" style="color:#1A3A6B">Catéchumènes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('sacrements.catechumenes.show', $catechumene) }}" style="color:#1A3A6B">{{ $catechumene->nom_complet }}</a></li>
    <li class="breadcrumb-item active">Modifier</li>
</ol></nav>

<div class="card">
    <div class="card-header fw-bold" style="background:#1A3A6B;color:#fff">
        <i class="bi bi-pencil me-2"></i>Modifier le dossier — {{ $catechumene->nom_complet }}
        <span class="badge bg-light text-dark ms-2">{{ $catechumene->numero_dossier }}</span>
    </div>
    <div class="card-body">
        <form action="{{ route('sacrements.catechumenes.update', $catechumene) }}" method="POST">
            @csrf @method('PUT')

            <h5 class="fw-bold mb-3 mt-2" style="color:#1A3A6B"><i class="bi bi-person me-2"></i>Identité</h5>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                    <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                           value="{{ old('nom', $catechumene->nom) }}" required>
                    @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Prénom <span class="text-danger">*</span></label>
                    <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror"
                           value="{{ old('prenom', $catechumene->prenom) }}" required>
                    @error('prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Sexe <span class="text-danger">*</span></label>
                    <select name="sexe" class="form-select" required>
                        <option value="M" {{ old('sexe', $catechumene->sexe)=='M'?'selected':'' }}>Masculin</option>
                        <option value="F" {{ old('sexe', $catechumene->sexe)=='F'?'selected':'' }}>Féminin</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Date de naissance <span class="text-danger">*</span></label>
                    <input type="date" name="date_naissance" class="form-control @error('date_naissance') is-invalid @enderror"
                           value="{{ old('date_naissance', $catechumene->date_naissance?->format('Y-m-d')) }}" required>
                    @error('date_naissance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Lieu de naissance</label>
                    <input type="text" name="lieu_naissance" class="form-control"
                           value="{{ old('lieu_naissance', $catechumene->lieu_naissance) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Nationalité</label>
                    <input type="text" name="nationalite" class="form-control"
                           value="{{ old('nationalite', $catechumene->nationalite) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Statut matrimonial</label>
                    <select name="statut_matrimonial" class="form-select">
                        <option value="">—</option>
                        @foreach(['celibataire'=>'Célibataire','marie'=>'Marié(e)','divorce'=>'Divorcé(e)','veuf'=>'Veuf/Veuve'] as $k=>$v)
                        <option value="{{ $k }}" {{ old('statut_matrimonial', $catechumene->statut_matrimonial)==$k?'selected':'' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Profession</label>
                    <input type="text" name="profession" class="form-control"
                           value="{{ old('profession', $catechumene->profession) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Religion actuelle</label>
                    <input type="text" name="religion_actuelle" class="form-control"
                           value="{{ old('religion_actuelle', $catechumene->religion_actuelle) }}">
                </div>
            </div>

            <h5 class="fw-bold mb-3" style="color:#1A3A6B"><i class="bi bi-geo-alt me-2"></i>Coordonnées</h5>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Téléphone</label>
                    <input type="text" name="telephone" class="form-control"
                           value="{{ old('telephone', $catechumene->telephone) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email', $catechumene->email) }}">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Adresse</label>
                    <textarea name="adresse" class="form-control" rows="2">{{ old('adresse', $catechumene->adresse) }}</textarea>
                </div>
            </div>

            <h5 class="fw-bold mb-3" style="color:#1A3A6B"><i class="bi bi-clipboard2-check me-2"></i>Inscription</h5>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Date d'inscription <span class="text-danger">*</span></label>
                    <input type="date" name="date_inscription" class="form-control"
                           value="{{ old('date_inscription', $catechumene->date_inscription?->format('Y-m-d')) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Groupe de catéchèse</label>
                    <select name="groupe_catechese_id" class="form-select">
                        <option value="">— Aucun groupe —</option>
                        @foreach($groupes as $g)
                        <option value="{{ $g->id }}" {{ old('groupe_catechese_id', $catechumene->groupe_catechese_id)==$g->id?'selected':'' }}>
                            {{ $g->nom }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Observations</label>
                    <textarea name="observations" class="form-control" rows="3">{{ old('observations', $catechumene->observations) }}</textarea>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom px-4">
                    <i class="bi bi-check-circle me-1"></i>Enregistrer les modifications
                </button>
                <a href="{{ route('sacrements.catechumenes.show', $catechumene) }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
