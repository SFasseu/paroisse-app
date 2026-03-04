@extends('layouts.app')

@section('content')
<div class="church-hero mb-5 animate-fade-in">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <h1 class="display-5 text-glow">💳 Gestion des Paiements</h1>
            <p class="lead text-white-50">Gérez tous les contributions de votre paroisse</p>
        </div>
        <div class="col-lg-4 d-flex gap-2">
            <a href="{{ route('payments.create') }}" class="btn btn-success btn-lg btn-icon flex-grow-1 btn-lift">
                <i class="fas fa-plus-circle bounce-icon"></i> Nouveau Paiement
            </a>
            <a href="{{ route('payments.report') }}" class="btn btn-info btn-lg btn-icon btn-lift">
                <i class="fas fa-file-csv bounce-icon"></i> Rapport
            </a>
        </div>
    </div>
</div>

<!-- Statistiques -->
<div class="row mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card card-hover shadow-lg border-0 stat-card-animated delay-100">
            <div class="card-body p-4" style="border-top: 4px solid #D4AF37;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">
                            <i class="fas fa-arrow-up"></i> Total Paiements
                        </div>
                        <div class="stat-number stat-number-animated" style="color: #D4AF37; font-size: 1.8rem;">
                            {{ number_format($stats['total_amount'], 0) }}
                        </div>
                        <small class="text-muted">FCFA</small>
                    </div>
                    <div class="counter-icon-rotating">
                        <i class="fas fa-coins text-gold-glow fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card card-hover shadow-lg border-0 stat-card-animated delay-200">
            <div class="card-body p-4" style="border-top: 4px solid #10b981;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">
                            <i class="fas fa-check"></i> Confirmés
                        </div>
                        <div class="stat-number stat-number-animated text-success fw-bold" style="font-size: 1.8rem;">
                            {{ $stats['confirmed_count'] }}
                        </div>
                        <small class="text-success fw-bold">Paiements</small>
                    </div>
                    <div class="counter-icon-rotating">
                        <i class="fas fa-check-circle text-success fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card card-hover shadow-lg border-0 stat-card-animated delay-300">
            <div class="card-body p-4" style="border-top: 4px solid #FFC107;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">
                            <i class="fas fa-hourglass"></i> En Attente
                        </div>
                        <div class="stat-number stat-number-animated fw-bold" style="color: #FFC107; font-size: 1.8rem;">
                            {{ $stats['pending_count'] }}
                        </div>
                        <small class="fw-bold" style="color: #FFC107;">À confirmer</small>
                    </div>
                    <div class="counter-icon-rotating">
                        <i class="fas fa-hourglass-half fs-1" style="color: #FFC107;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card card-hover shadow-lg border-0 stat-card-animated delay-400">
            <div class="card-body p-4" style="border-top: 4px solid #2F5233;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">
                            <i class="fas fa-calculator"></i> Montant Moyen
                        </div>
                        <div class="stat-number stat-number-animated fw-bold" style="color: #2F5233; font-size: 1.8rem;">
                            {{ number_format(($stats['total_amount'] ?? 0) / max($stats['total_count'] ?? 1, 1), 0) }}
                        </div>
                        <small class="fw-bold" style="color: #2F5233;">FCFA</small>
                    </div>
                    <div class="counter-icon-rotating">
                        <i class="fas fa-chart-line fs-1" style="color: #2F5233;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Table des paiements -->
<div class="card shadow-lg border-0 animate-slide-up delay-200">
    <div class="card-header text-white" style="background: linear-gradient(135deg, #4169E1, #2F5233);">
        <h5 class="mb-0">
            <i class="fas fa-list me-2 text-gold-glow"></i> 📋 Liste des Paiements Récents
        </h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead style="background: linear-gradient(135deg, #4169E1, #2F5233); color: white; border-bottom: 3px solid #D4AF37;">
                <tr>
                    <th class="text-white fw-bold"><i class="fas fa-calendar text-gold-glow"></i> Date</th>
                    <th class="text-white fw-bold"><i class="fas fa-tag text-gold-glow"></i> Type</th>
                    <th class="text-white fw-bold"><i class="fas fa-money-bill text-gold-glow"></i> Montant</th>
                    <th class="text-white fw-bold"><i class="fas fa-credit-card text-gold-glow"></i> Méthode</th>
                    <th class="text-white fw-bold"><i class="fas fa-info-circle text-gold-glow"></i> Statut</th>
                    <th class="text-white fw-bold"><i class="fas fa-cogs text-gold-glow"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr class="animate-fade-in transition-all" style="cursor: pointer; border-left: 4px solid #4169E1;" 
                    onclick="window.location='{{ route('payments.show', $payment) }}';" 
                    onmouseover="this.style.backgroundColor='rgba(65, 105, 225, 0.15)'; this.style.borderLeftColor='#D4AF37';" 
                    onmouseout="this.style.backgroundColor=''; this.style.borderLeftColor='#4169E1';">
                    <td>
                        <strong style="color: #4169E1;">{{ $payment->payment_date->format('d/m/Y') }}</strong>
                        <br><small class="text-muted">{{ $payment->payment_date->format('H:i') }}</small>
                    </td>
                    <td>
                        @foreach($payment->items as $item)
                            @if($item->itemable_type === 'App\Models\MassIntention')
                                <span class="badge bg-info badge-pop" style="font-size: 0.95rem; padding: 0.5rem 0.75rem; margin-bottom: 0.25rem; animation-delay: {{ $loop->index * 0.1 }}s;">
                                    <i class="fas fa-cross me-1"></i> Intention
                                </span>
                            @elseif($item->itemable_type === 'App\Models\Article')
                                <span class="badge bg-success badge-pop" style="font-size: 0.95rem; padding: 0.5rem 0.75rem; margin-bottom: 0.25rem; animation-delay: {{ $loop->index * 0.1 }}s;">
                                    <i class="fas fa-book me-1"></i> Article
                                </span>
                            @elseif($item->itemable_type === 'App\Models\Parking')
                                <span class="badge bg-warning text-dark badge-pop" style="font-size: 0.95rem; padding: 0.5rem 0.75rem; margin-bottom: 0.25rem; animation-delay: {{ $loop->index * 0.1 }}s;">
                                    <i class="fas fa-car me-1"></i> Parking
                                </span>
                            @else
                                <span class="badge bg-secondary badge-pop" style="font-size: 0.95rem; padding: 0.5rem 0.75rem; margin-bottom: 0.25rem;">
                                    Item
                                </span>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <strong style="font-size: 1.1rem; color: #4169E1;">
                            {{ number_format($payment->amount, 0) }}
                        </strong>
                        <br><small class="text-muted">{{ $payment->currency }}</small>
                    </td>
                    <td>
                        @if($payment->method)
                            <small class="fw-bold">
                                <i class="fas fa-{% if(strtolower($payment->method->code) === 'cash') %}money-bill-wave{% elseif(strpos(strtolower($payment->method->code), 'mobile') !== false) %}mobile-alt{% elseif(strpos(strtolower($payment->method->code), 'virement') !== false) %}university{% else %}receipt{% endif %} me-2" style="color: #2F5233;"></i>
                                {{ $payment->method->name }}
                            </small>
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
                    <td onclick="event.stopPropagation();">
                        <div class="btn-group" role="group">
                            <a href="{{ route('payments.edit', $payment) }}" class="btn btn-sm btn-outline-warning" title="Éditer">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('payments.destroy', $payment) }}" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce paiement?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <i class="fas fa-inbox fs-1 text-muted mb-3"></i>
                        <p class="text-muted">Aucun paiement enregistré. <a href="{{ route('payments.create') }}" class="link-church">Créer un nouveau</a></p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-light">
        {{ $payments->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
