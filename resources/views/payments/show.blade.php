@extends('layouts.app')

@section('content')
<div class="church-hero mb-5">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <h1 class="display-5">💳 Détails du Paiement</h1>
            <p class="lead text-white-50">Ref: <strong>{{ $payment->reference_number }}</strong></p>
        </div>
        <div class="col-lg-4 text-right">
            <a href="{{ route('payments.index') }}" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
            @if($payment->status !== 'confirmed')
                <a href="{{ route('payments.edit', $payment) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Éditer
                </a>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <!-- Informations Principales -->
    <div class="col-lg-8">
        <div class="card shadow-lg border-0 mb-4">
            <div class="card-header text-white" style="background: linear-gradient(135deg, #4169E1, #2F5233);">
                <h5 class="mb-0">📝 Informations du Paiement</h5>
            </div>
            <div class="card-body p-4">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="text-muted small">Date du Paiement</label>
                        <p class="fs-5 font-weight-bold">{{ $payment->payment_date->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Statut</label>
                        <p>
                            @if($payment->status === 'confirmed')
                                <span class="badge bg-success" style="font-size: 1rem; padding: 0.5rem 0.75rem;">✓ Confirmé</span>
                            @elseif($payment->status === 'pending')
                                <span class="badge bg-warning text-dark" style="font-size: 1rem; padding: 0.5rem 0.75rem;">⏳ En Attente</span>
                            @else
                                <span class="badge bg-danger" style="font-size: 1rem; padding: 0.5rem 0.75rem;">✗ Annulé</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="text-muted small">Montant</label>
                        <p class="fs-4 text-church-primary font-weight-bold">
                            {{ number_format($payment->amount, 0) }} <small class="text-muted">{{ $payment->currency }}</small>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Méthode de Paiement</label>
                        <p class="fs-5 font-weight-bold">
                            @if($payment->method)
                                <i class="fas fa-credit-card me-2"></i>
                                {{ $payment->method->name }}
                                @if($payment->method->system)
                                    <br><small class="text-muted">Système: {{ $payment->method->system->name }}</small>
                                @endif
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </p>
                    </div>
                </div>

                @if($payment->description)
                    <div class="mb-3">
                        <label class="text-muted small">Description</label>
                        <p class="fs-5">{{ $payment->description }}</p>
                    </div>
                @endif

                @if($payment->notes)
                    <div class="mb-3">
                        <label class="text-muted small">Notes</label>
                        <p class="fs-5">{{ $payment->notes }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Articles du Paiement -->
        <div class="card shadow-lg border-0 mb-4">
            <div class="card-header text-white" style="background: linear-gradient(135deg, #4169E1, #2F5233);">
                <h5 class="mb-0">📦 Articles du Paiement</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background: #f8f9fa;">
                        <tr>
                            <th><i class="fas fa-list"></i> Type</th>
                            <th><i class="fas fa-tag"></i> Description</th>
                            <th><i class="fas fa-hashtag"></i> Quantité</th>
                            <th><i class="fas fa-money-bill"></i> Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payment->items as $item)
                        <tr>
                            <td>
                                @if($item->itemable_type === 'App\Models\MassIntention')
                                    <span class="badge bg-info">Intention de Messe</span>
                                @elseif($item->itemable_type === 'App\Models\Article')
                                    <span class="badge bg-success">Article</span>
                                @elseif($item->itemable_type === 'App\Models\Parking')
                                    <span class="badge bg-warning">Parking</span>
                                @else
                                    <span class="badge bg-secondary">Item</span>
                                @endif
                            </td>
                            <td>
                                <strong>
                                    @if($item->itemable)
                                        @if($item->itemable_type === 'App\Models\MassIntention')
                                            {{ $item->itemable->name }}
                                        @elseif($item->itemable_type === 'App\Models\Article')
                                            {{ $item->itemable->name }}
                                        @elseif($item->itemable_type === 'App\Models\Parking')
                                            {{ $item->itemable->location }}
                                        @endif
                                    @else
                                        Item supprimé
                                    @endif
                                </strong>
                                @if($item->description)
                                    <br><small class="text-muted">{{ $item->description }}</small>
                                @endif
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                <strong class="text-church-primary">
                                    {{ number_format($item->amount, 0) }}
                                </strong>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">
                                Aucun article pour ce paiement
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Informations Utilisateur -->
        <div class="card shadow-lg border-0 mb-4">
            <div class="card-header text-white" style="background: linear-gradient(135deg, #D4AF37, #FFA500);">
                <h5 class="mb-0">👤 Utilisateur</h5>
            </div>
            <div class="card-body p-4">
                @if($payment->user)
                    <p class="fs-5 font-weight-bold">{{ $payment->user->name }}</p>
                    <p class="text-muted">
                        <i class="fas fa-envelope me-2"></i>
                        {{ $payment->user->email }}
                    </p>
                @else
                    <p class="text-muted">Utilisateur supprimé</p>
                @endif
            </div>
        </div>

        <!-- Informations de Confirmation -->
        @if($payment->status === 'confirmed')
        <div class="card shadow-lg border-0 mb-4">
            <div class="card-header text-white" style="background: linear-gradient(135deg, #2F5233, #228B22);">
                <h5 class="mb-0">✓ Confirmation</h5>
            </div>
            <div class="card-body p-4">
                <p class="text-muted small">Confirmé le:</p>
                <p class="fs-5 font-weight-bold">{{ $payment->confirmed_at->format('d/m/Y H:i') }}</p>
                
                @if($payment->confirmedBy)
                <p class="text-muted small mt-3">Par:</p>
                <p class="fs-5 font-weight-bold">{{ $payment->confirmedBy->name }}</p>
                @endif
            </div>
        </div>
        @endif

        <!-- Actions -->
        <div class="card shadow-lg border-0">
            <div class="card-header text-white" style="background: linear-gradient(135deg, #4169E1, #2F5233);">
                <h5 class="mb-0">⚙️ Actions</h5>
            </div>
            <div class="card-body p-4">
                @if($payment->status === 'pending')
                    <form action="{{ route('payments.confirm', $payment) }}" method="POST" class="mb-2">
                        @csrf
                        <button class="btn btn-success w-100 btn-icon mb-2">
                            <i class="fas fa-check-circle me-2"></i> Confirmer
                        </button>
                    </form>
                @endif

                @if($payment->status !== 'cancelled')
                    <form action="{{ route('payments.cancel', $payment) }}" method="POST" class="mb-2">
                        @csrf
                        <button class="btn btn-warning w-100 btn-icon mb-2">
                            <i class="fas fa-times me-2"></i> Annuler
                        </button>
                    </form>
                @endif

                @if($payment->status !== 'confirmed')
                    <a href="{{ route('payments.edit', $payment) }}" class="btn btn-primary w-100 btn-icon mb-2">
                        <i class="fas fa-edit me-2"></i> Éditer
                    </a>
                @endif

                <form action="{{ route('payments.destroy', $payment) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce paiement?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger w-100 btn-icon">
                        <i class="fas fa-trash me-2"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

