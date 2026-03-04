@extends('layouts.app')

@section('content')
<div class="church-hero mb-4 animate-fade-in">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <h1 class="display-5 text-glow">📊 Rapport des Paiements</h1>
            <p class="lead text-white-50">Filtrez et analysez les paiements par critères</p>
        </div>
        <div class="col-lg-4">
            <a href="{{ route('payments.index') }}" class="btn btn-secondary btn-lg btn-lift">
                <i class="fas fa-list bounce-icon"></i> Voir Paiements
            </a>
        </div>
    </div>
</div>

<!-- Filtres -->
<div class="card shadow-lg border-0 mb-4 animate-slide-up delay-100">
    <div class="card-header text-white" style="background: linear-gradient(135deg, #4169E1, #2F5233);">
        <h5 class="mb-0 text-glow">
            <i class="fas fa-filter me-2"></i> Filtres de Recherche
        </h5>
    </div>

    <form method="GET" action="{{ route('payments.report') }}" class="p-4">
        <div class="row">
            <!-- Type d'Item -->
            <div class="col-md-3 mb-3">
                <label class="church-label">Type d'Item</label>
                <select name="item_type" class="form-control">
                    <option value="">-- Tous --</option>
                    @foreach($types as $key => $label)
                        <option value="{{ $key }}" @selected(request('item_type') === $key)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Statut -->
            <div class="col-md-3 mb-3">
                <label class="church-label">Statut</label>
                <select name="status" class="form-control">
                    <option value="">-- Tous --</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" @selected(request('status') === $status)>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Méthode de Paiement -->
            <div class="col-md-3 mb-3">
                <label class="church-label">Méthode</label>
                <select name="payment_method_id" class="form-control">
                    <option value="">-- Toutes --</option>
                    @foreach($methods as $method)
                        <option value="{{ $method->id }}" @selected(request('payment_method_id') == $method->id)>
                            {{ $method->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Bouton Filtrer -->
            <div class="col-md-3 mb-3">
                <label class="church-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary btn-icon w-100">
                    <i class="fas fa-search me-2"></i> Filtrer
                </button>
            </div>
        </div>

        <!-- Dates -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="church-label">Date Début</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>

            <div class="col-md-4 mb-3">
                <label class="church-label">Date Fin</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>

            <div class="col-md-4 mb-3">
                <label class="church-label">&nbsp;</label>
                <a href="{{ route('payments.report') }}" class="btn btn-secondary btn-icon w-100">
                    <i class="fas fa-redo me-2"></i> Réinitialiser
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Statistiques du Rapport -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card card-hover shadow-lg border-0 stat-card-animated delay-100">
            <div class="card-body text-center" style="border-left: 4px solid #4169E1;">
                <div class="counter-icon-rotating mb-2">
                    <i class="fas fa-coins fa-2x text-church-primary"></i>
                </div>
                <h6 class="text-muted text-uppercase fw-bold mb-2">
                    <i class="fas fa-arrow-up"></i> Montant Total
                </h6>
                <h3 class="stat-number-animated" style="color: #4169E1; font-weight: 700;">
                    {{ number_format($stats['total_amount'] ?? 0, 0) }}
                </h3>
                <small class="text-church-secondary">FCFA</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-hover shadow-lg border-0 stat-card-animated delay-200">
            <div class="card-body text-center" style="border-left: 4px solid #10b981;">
                <div class="counter-icon-rotating mb-2">
                    <i class="fas fa-check-circle fa-2x text-success"></i>
                </div>
                <h6 class="text-muted text-uppercase fw-bold mb-2">
                    <i class="fas fa-check"></i> Confirmés
                </h6>
                <h3 class="stat-number-animated text-success fw-bold">
                    {{ number_format($stats['confirmed_amount'] ?? 0, 0) }}
                </h3>
                <small class="text-success fw-bold">({{ $stats['confirmed_count'] ?? 0 }} paiements)</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-hover shadow-lg border-0 stat-card-animated delay-300">
            <div class="card-body text-center" style="border-left: 4px solid #D4AF37;">
                <div class="counter-icon-rotating mb-2">
                    <i class="fas fa-clock fa-2x" style="color: #D4AF37;"></i>
                </div>
                <h6 class="text-muted text-uppercase fw-bold mb-2">
                    <i class="fas fa-hourglass"></i> En Attente
                </h6>
                <h3 class="stat-number-animated fw-bold" style="color: #D4AF37;">
                    {{ number_format($stats['pending_amount'] ?? 0, 0) }}
                </h3>
                <small class="fw-bold" style="color: #D4AF37;">({{ $stats['pending_count'] ?? 0 }} paiements)</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-hover shadow-lg border-0 stat-card-animated delay-400">
            <div class="card-body text-center" style="border-left: 4px solid #2F5233;">
                <div class="counter-icon-rotating mb-2">
                    <i class="fas fa-chart-line fa-2x" style="color: #2F5233;"></i>
                </div>
                <h6 class="text-muted text-uppercase fw-bold mb-2">
                    <i class="fas fa-calculator"></i> Montant Moyen
                </h6>
                <h3 class="stat-number-animated fw-bold" style="color: #2F5233;">
                    {{ number_format((($stats['total_amount'] ?? 0) / max(($stats['total_count'] ?? 1), 1)), 0) }}
                </h3>
                <small class="fw-bold" style="color: #2F5233;">FCFA</small>
            </div>
        </div>
    </div>
</div>

<!-- Table des Résultats -->
<div class="card shadow-lg border-0 animate-slide-up delay-200">
    <div class="card-header text-white" style="background: linear-gradient(135deg, #4169E1, #2F5233);">
        <h5 class="mb-0">
            <i class="fas fa-file-csv me-2 text-gold-glow"></i> 📋 Résultats du Rapport ({{ $payments->total() }} paiements)
        </h5>
    </div>

    @if($payments->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead style="background: linear-gradient(135deg, #4169E1, #2F5233); border-bottom: 3px solid #D4AF37;">
                <tr style="color: white;">
                    <th class="text-white fw-bold"><i class="fas fa-calendar text-gold-glow"></i> Date</th>
                    <th class="text-white fw-bold"><i class="fas fa-tag text-gold-glow"></i> Type</th>
                    <th class="text-white fw-bold"><i class="fas fa-file-alt text-gold-glow"></i> Description</th>
                    <th class="text-white fw-bold"><i class="fas fa-money-bill text-gold-glow"></i> Montant</th>
                    <th class="text-white fw-bold"><i class="fas fa-credit-card text-gold-glow"></i> Méthode</th>
                    <th class="text-white fw-bold"><i class="fas fa-check-circle text-gold-glow"></i> Statut</th>
                    <th class="text-white fw-bold"><i class="fas fa-cogs text-gold-glow"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr class="align-middle animate-fade-in transition-all" style="border-left: 4px solid #4169E1; transition: all 0.3s ease;">
                    <td>
                        <small class="text-muted">{{ $payment->payment_date->format('d/m/Y') }}</small><br>
                        <strong style="color: #4169E1;">{{ $payment->payment_date->format('H:i') }}</strong>
                    </td>
                    <td>
                        @if($payment->items->count() > 0)
                            @foreach($payment->items as $item)
                                @if($item->itemable_type === 'App\Models\MassIntention')
                                    <span class="badge bg-info badge-pop" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                                        <i class="fas fa-cross me-1"></i> Intention
                                    </span>
                                @elseif($item->itemable_type === 'App\Models\Article')
                                    <span class="badge bg-success badge-pop" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                                        <i class="fas fa-book me-1"></i> Article
                                    </span>
                                @elseif($item->itemable_type === 'App\Models\Parking')
                                    <span class="badge bg-warning text-dark badge-pop" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                                        <i class="fas fa-car me-1"></i> Parking
                                    </span>
                                @else
                                    <span class="badge bg-secondary badge-pop">Item</span>
                                @endif
                            @endforeach
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        @if($payment->items->count() > 0)
                            @foreach($payment->items as $item)
                                <small class="fw-bold">
                                    @if($item->itemable)
                                        @if($item->itemable_type === 'App\Models\MassIntention')
                                            <i class="fas fa-cross me-1" style="color: #4169E1;"></i> {{ $item->itemable->name }}
                                        @elseif($item->itemable_type === 'App\Models\Article')
                                            <i class="fas fa-book me-1" style="color: #10b981;"></i> {{ $item->itemable->name }}
                                        @elseif($item->itemable_type === 'App\Models\Parking')
                                            <i class="fas fa-car me-1" style="color: #D4AF37;"></i> {{ $item->itemable->location }}
                                        @endif
                                    @else
                                        <em class="text-danger">⚠️ Item supprimé</em>
                                    @endif
                                </small>
                                @if(!$loop->last)<br>@endif
                            @endforeach
                        @endif
                    </td>
                    <td>
                        <strong style="font-size: 1.1rem; color: #4169E1;">
                            {{ number_format($payment->amount, 0) }}
                        </strong>
                        <br><small class="text-muted">{{ $payment->currency }}</small>
                    </td>
                    <td>
                        @if($payment->method)
                            <small class="fw-bold">{{ $payment->method->name }}</small>
                            @if($payment->method->system)
                                <br><small class="text-muted">({{ $payment->method->system->name }})</small>
                            @endif
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td>
                        @if($payment->status === 'confirmed')
                            <span class="badge bg-success badge-float" style="font-size: 0.9rem;">
                                <i class="fas fa-check-circle"></i> Confirmé
                            </span>
                        @elseif($payment->status === 'pending')
                            <span class="badge bg-warning text-dark badge-float" style="font-size: 0.9rem;">
                                <i class="fas fa-hourglass-half"></i> Attente
                            </span>
                        @else
                            <span class="badge bg-danger badge-float" style="font-size: 0.9rem;">
                                <i class="fas fa-times-circle"></i> Annulé
                            </span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('payments.show', $payment) }}" class="btn btn-sm btn-info btn-icon btn-lift" title="Voir">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('payments.edit', $payment) }}" class="btn btn-sm btn-warning btn-icon" title="Éditer">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer bg-light d-flex justify-content-between align-items-center">
        <div>
            <small class="text-muted">
                Affichage {{ $payments->firstItem() }} à {{ $payments->lastItem() }} sur {{ $payments->total() }} résultats
            </small>
        </div>
        <div>
            {{ $payments->links('pagination::bootstrap-4') }}
        </div>
    </div>
    @else
    <div class="card-body">
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Aucun paiement</strong> ne correspond à vos critères de filtrage.
        </div>
    </div>
    @endif
</div>

<!-- Lien rapide -->
<div class="mt-4">
    <a href="{{ route('payments.create') }}" class="btn btn-success btn-lg btn-icon">
        <i class="fas fa-plus-circle me-2"></i> Nouveau Paiement
    </a>
    <a href="{{ route('payments.index') }}" class="btn btn-secondary btn-lg">
        <i class="fas fa-list me-2"></i> Retour à la liste
    </a>
</div>
@endsection
