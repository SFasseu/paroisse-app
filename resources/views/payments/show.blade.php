@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header text-white" style="background: linear-gradient(135deg, #4169E1, #2F5233);">
                <h4 class="mb-0">
                    <i class="fas fa-eye me-2"></i> Détails du Paiement #{{ $payment->id }}
                </h4>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Statut</p>
                        <div class="mb-3">
                            @if($payment->status === 'confirmed')
                                <span class="badge bg-success badge-lg">
                                    <i class="fas fa-check-circle"></i> Confirmé
                                </span>
                            @elseif($payment->status === 'pending')
                                <span class="badge bg-warning badge-lg">
                                    <i class="fas fa-hourglass-half"></i> En Attente
                                </span>
                            @else
                                <span class="badge bg-danger badge-lg">
                                    <i class="fas fa-times-circle"></i> Annulé
                                </span>
                            @endif
                        </div>

                        <p class="text-muted mb-1">Montant</p>
                        <h3 class="text-church-primary mb-3">
                            {{ number_format($payment->amount, 0) }} {{ $payment->currency }}
                        </h3>

                        <p class="text-muted mb-1">Type de Paiement</p>
                        <p class="mb-3">
                            @switch($payment->payment_type)
                                @case('tithe') <span class="badge bg-primary">La Dîme</span> @break
                                @case('donation') <span class="badge bg-info">Don</span> @break
                                @case('offering') <span class="badge bg-success">Offrande</span> @break
                                @case('service') <span class="badge bg-warning">Service</span> @break
                            @endswitch
                        </p>
                    </div>

                    <div class="col-md-6">
                        <p class="text-muted mb-1">Méthode de Paiement</p>
                        <p class="mb-3">
                            @switch($payment->payment_method)
                                @case('cash') <i class="fas fa-money-bill"></i> Espèces @break
                                @case('mobile_money') <i class="fas fa-mobile-alt"></i> Mobile Money @break
                                @case('bank_transfer') <i class="fas fa-university"></i> Virement Bancaire @break
                                @case('check') <i class="fas fa-receipt"></i> Chèque @break
                            @endswitch
                        </p>

                        <p class="text-muted mb-1">Numéro de Référence</p>
                        <p class="mb-3">
                            <code class="bg-light p-2 rounded">{{ $payment->reference_number }}</code>
                        </p>

                        <p class="text-muted mb-1">Contenant</p>
                        <p>{{ $payment->user->name ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Informations Détaillées -->
                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Date du Paiement</p>
                        <p class="mb-3">{{ $payment->payment_date->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Créé le</p>
                        <p class="mb-3">{{ $payment->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                @if($payment->description)
                <div class="mb-3">
                    <p class="text-muted mb-1">Description</p>
                    <p>{{ $payment->description }}</p>
                </div>
                @endif

                @if($payment->notes)
                <div class="mb-3">
                    <p class="text-muted mb-1">Notes</p>
                    <p>{{ $payment->notes }}</p>
                </div>
                @endif

                @if($payment->confirmed_at)
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Confirmé le:</strong> {{ $payment->confirmed_at->format('d/m/Y H:i') }}
                    @if($payment->confirmed_by)
                        <br><strong>Par:</strong> {{ $payment->confirmedBy->name ?? 'N/A' }}
                    @endif
                </div>
                @endif
            </div>

            <!-- Actions -->
            <div class="card-footer bg-light">
                <div class="d-flex gap-2">
                    @if($payment->status !== 'confirmed')
                    <form action="{{ route('payments.confirm', $payment) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-icon" title="Confirmer le paiement">
                            <i class="fas fa-check-circle"></i> Confirmer
                        </button>
                    </form>
                    @endif

                    @if($payment->status !== 'cancelled')
                    <form action="{{ route('payments.cancel', $payment) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-icon" title="Annuler le paiement">
                            <i class="fas fa-times-circle"></i> Annuler
                        </button>
                    </form>
                    @endif

                    <a href="{{ route('payments.edit', $payment) }}" class="btn btn-warning btn-icon">
                        <i class="fas fa-edit"></i> Éditer
                    </a>

                    <a href="{{ route('payments.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div class="col-md-4">
        <div class="info-box">
            <i class="fas fa-shield-alt me-2"></i>
            <strong>Sécurité:</strong><br>
            <small class="text-muted">Tous les paiements sont enregistrés de manière sécurisée et tracés.</small>
        </div>

        <div class="highlight-box mt-3">
            <i class="fas fa-lightbulb me-2"></i>
            <strong>Conseil:</strong><br>
            <small class="text-muted">Vérifiez tous les détails avant de confirmer un paiement.</small>
        </div>
    </div>
</div>
@endsection
