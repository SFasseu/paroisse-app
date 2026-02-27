@extends('sacrements.layouts.sacrements')
@section('title', 'Catéchistes')
@section('content')
<nav aria-label="breadcrumb"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('sacrements.dashboard') }}" style="color:#1A3A6B">Tableau de bord</a></li>
    <li class="breadcrumb-item active">Catéchistes</li>
</ol></nav>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0" style="color:#1A3A6B"><i class="bi bi-person-badge me-2"></i>Catéchistes</h2>
    <a href="{{ route('sacrements.catechistes.create') }}" class="btn btn-primary-custom"><i class="bi bi-plus-circle me-1"></i> Nouveau Catéchiste</a>
</div>
<div class="row g-3">
    @forelse($catechistes as $cat)
    <div class="col-md-6 col-lg-4">
        <div class="card h-100">
            <div class="card-body text-center">
                @if($cat->photo)
                <img src="{{ Storage::url($cat->photo) }}" alt="Photo" class="rounded-circle mb-3"
                     style="width:80px;height:80px;object-fit:cover;border:3px solid #1A3A6B">
                @else
                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                     style="width:80px;height:80px;background:#e8f0fb;border:3px solid #1A3A6B">
                    <i class="bi bi-person-fill fs-2" style="color:#1A3A6B"></i>
                </div>
                @endif
                <h5 class="fw-bold mb-1" style="color:#1A3A6B">{{ $cat->nom_complet }}</h5>
                <p class="text-muted small mb-2">{{ $cat->specialite ?? 'Catéchiste' }}</p>
                <div class="text-muted small mb-2">
                    @if($cat->telephone)<div><i class="bi bi-phone me-1"></i>{{ $cat->telephone }}</div>@endif
                    @if($cat->email)<div><i class="bi bi-envelope me-1"></i>{{ $cat->email }}</div>@endif
                </div>
                <span class="badge rounded-pill bg-light text-dark border mb-2">
                    <i class="bi bi-collection me-1"></i>{{ $cat->groupes_count }} groupe(s)
                </span>
                <span class="badge {{ $cat->actif?'bg-success':'bg-secondary' }} ms-1 mb-2">
                    {{ $cat->actif?'Actif':'Inactif' }}
                </span>
            </div>
            <div class="card-footer d-flex gap-1 justify-content-center">
                <a href="{{ route('sacrements.catechistes.show', $cat) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye me-1"></i>Voir</a>
                <a href="{{ route('sacrements.catechistes.edit', $cat) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil me-1"></i>Modifier</a>
                <form action="{{ route('sacrements.catechistes.destroy', $cat) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Supprimer ce catéchiste ?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12"><div class="alert alert-info">Aucun catéchiste enregistré.</div></div>
    @endforelse
</div>
@if($catechistes->hasPages())<div class="mt-3">{{ $catechistes->links() }}</div>@endif
@endsection
