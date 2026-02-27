@extends('sacrements.layouts.sacrements')
@section('title', 'Nouveau Catéchumène')
@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.catechumenes.index') }}" style="color:#1A3A6B">Catéchumènes</a></li>
    <li class="breadcrumb-item active">Nouveau</li>
</ol></nav>

<div class="card">
    <div class="card-header fw-bold" style="background:#1A3A6B;color:#fff">
        <i class="bi bi-person-plus me-2"></i>Inscrire un nouveau catéchumène
    </div>
    <div class="card-body">
        <form action="{{ route('sacrements.catechumenes.store') }}" method="POST">
            @csrf

            {{-- Section 1: Identité --}}
            <h5 class="fw-bold mb-3 mt-2" style="color:#1A3A6B"><i class="bi bi-person me-2"></i>Identité</h5>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                    <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                           value="{{ old('nom') }}" placeholder="NOM (majuscules)" required>
                    @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Prénom <span class="text-danger">*</span></label>
                    <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror"
                           value="{{ old('prenom') }}" placeholder="Prénom(s)" required>
                    @error('prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Sexe <span class="text-danger">*</span></label>
                    <select name="sexe" class="form-select @error('sexe') is-invalid @enderror" required>
                        <option value="">— Sélectionner —</option>
                        <option value="M" {{ old('sexe')=='M'?'selected':'' }}>Masculin</option>
                        <option value="F" {{ old('sexe')=='F'?'selected':'' }}>Féminin</option>
                    </select>
                    @error('sexe')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Date de naissance <span class="text-danger">*</span></label>
                    <input type="date" name="date_naissance" class="form-control @error('date_naissance') is-invalid @enderror"
                           value="{{ old('date_naissance') }}" required>
                    @error('date_naissance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Lieu de naissance</label>
                    <input type="text" name="lieu_naissance" class="form-control"
                           value="{{ old('lieu_naissance') }}" placeholder="ex: Douala, Cameroun">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Nationalité</label>
                    <input type="text" name="nationalite" class="form-control"
                           value="{{ old('nationalite', 'Camerounaise') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Statut matrimonial</label>
                    <select name="statut_matrimonial" class="form-select">
                        <option value="">— Sélectionner —</option>
                        @foreach(['celibataire'=>'Célibataire','marie'=>'Marié(e)','divorce'=>'Divorcé(e)','veuf'=>'Veuf/Veuve'] as $k=>$v)
                        <option value="{{ $k }}" {{ old('statut_matrimonial')==$k?'selected':'' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Profession</label>
                    <input type="text" name="profession" class="form-control"
                           value="{{ old('profession') }}" placeholder="ex: Élève, Commerçant...">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Religion actuelle (avant catéchèse)</label>
                    <input type="text" name="religion_actuelle" class="form-control"
                           value="{{ old('religion_actuelle') }}" placeholder="ex: Protestant, Sans religion...">
                </div>
            </div>

            {{-- Section 2: Coordonnées --}}
            <h5 class="fw-bold mb-3" style="color:#1A3A6B"><i class="bi bi-geo-alt me-2"></i>Coordonnées</h5>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Téléphone</label>
                    <input type="text" name="telephone" class="form-control"
                           value="{{ old('telephone') }}" placeholder="+237 6XX XXX XXX">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email') }}" placeholder="email@exemple.cm">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Adresse</label>
                    <textarea name="adresse" class="form-control" rows="2"
                              placeholder="Quartier, rue, ville...">{{ old('adresse') }}</textarea>
                </div>
            </div>

            {{-- Section 3: Inscription --}}
            <h5 class="fw-bold mb-3" style="color:#1A3A6B"><i class="bi bi-clipboard2-check me-2"></i>Inscription</h5>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Date d'inscription <span class="text-danger">*</span></label>
                    <input type="date" name="date_inscription" class="form-control @error('date_inscription') is-invalid @enderror"
                           value="{{ old('date_inscription', date('Y-m-d')) }}" required>
                    @error('date_inscription')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Groupe de catéchèse</label>
                    <select name="groupe_catechese_id" class="form-select @error('groupe_catechese_id') is-invalid @enderror">
                        <option value="">— Aucun groupe —</option>
                        @foreach($groupes as $g)
                        <option value="{{ $g->id }}" {{ old('groupe_catechese_id')==$g->id || request('groupe')==$g->id ? 'selected' : '' }}>
                            {{ $g->nom }} ({{ $g->niveauFormation->nom ?? '' }})
                        </option>
                        @endforeach
                    </select>
                    @error('groupe_catechese_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Statut initial</label>
                    <select name="statut" class="form-select">
                        <option value="inscrit" {{ old('statut','inscrit')=='inscrit'?'selected':'' }}>Inscrit</option>
                        <option value="en_cours" {{ old('statut')=='en_cours'?'selected':'' }}>En cours</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Observations</label>
                    <textarea name="observations" class="form-control" rows="3"
                              placeholder="Notes particulières, informations complémentaires...">{{ old('observations') }}</textarea>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom px-4">
                    <i class="bi bi-check-circle me-1"></i>Créer le dossier
                </button>
                <a href="{{ route('sacrements.catechumenes.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
