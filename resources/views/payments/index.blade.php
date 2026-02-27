@extends('layouts.app')

@section('content')
<div class="church-hero mb-5">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <h1 class="display-5">💳 Gestion des Paiements</h1>
            <p class="lead text-white-50">Gérez tous les contributions de votre paroisse</p>
        </div>
        <div class="col-lg-4">
            <a href="{{ route('payments.create') }}" class="btn btn-success btn-lg btn-icon">
                <i class="fas fa-plus-circle"></i> Nouveau Paiement
            </a>
        </div>
    </div>
</div>

<!-- Statistiques -->
<div class="row mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card card-hover shadow-sm border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-muted small">Total Paiements</div>
                        <div class="stat-number">{{ number_format($stats['total_amount'], 0) }}</div>
                        <small class="text-muted">FCFA</small>
                    </div>
                    <i class="fas fa-coins text-warning fs-1"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card card-hover shadow-sm border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-muted small">Confirmés</div>
                        <div class="stat-number text-success">{{ $stats['confirmed_count'] }}</div>
                        <small class="text-muted">Paiements</small>
                    </div>
                    <i class="fas fa-check-circle text-success fs-1"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card card-hover shadow-sm border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-muted small">En Attente</div>
                        <div class="stat-number text-warning">{{ $stats['pending_count'] }}</div>
                        <small class="text-muted">À confirmer</small>
                    </div>
                    <i class="fas fa-hourglass-half text-warning fs-1"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card card-hover shadow-sm border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="text-muted small">Total Moyens</div>
                        <div class="stat-number text-info">
                            {{ number_format(($stats['total_amount'] ?? 0) / max($stats['total_count'] ?? 1, 1), 0) }}
                        </div>
                        <small class="text-muted">FCFA</small>
                    </div>
                    <i class="fas fa-calculator text-info fs-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Table des paiements -->
<div class="card shadow-lg border-0">
    <div class="card-header text-white" style="background: linear-gradient(135deg, #4169E1, #2F5233);">
        <h5 class="mb-0">📋 Liste des Paiements Récents</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead style="background: linear-gradient(135deg, #4169E1, #2F5233); color: white;">
                <tr>
                    <th><i class="fas fa-calendar"></i> Date</th>
                    <th><i class="fas fa-tag"></i> Type</th>
                    <th><i class="fas fa-money-bill"></i> Montant</th>
                    <th><i class="fas fa-credit-card"></i> Méthode</th>
                    <th><i class="fas fa-info-circle"></i> Statut</th>
                    <th><i class="fas fa-cogs"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->payment_date->format('d/m/Y H:i') }}</td>
                    <td>
                        <span class="badge bg-primary">
                            @switch($payment->payment_type)
                                @case('tithe') La Dîme @break
                                @case('donation') Don @break
                                @case('offering') Offrande @break
                                @case('service') Service @break
                            @endswitch
                        </span>
                    </td>
                    <td>
                        <strong class="text-church-primary">
                            {{ number_format($payment->amount, 0) }} {{ $payment->currency }}
                        </strong>
                    </td>
                    <td>
                        <i class="fas fa-{% if($payment->payment_method === 'cash') %}money-bill{% elseif($payment->payment_method === 'mobile_money') %}mobile-alt{% elseif($payment->payment_method === 'bank_transfer') %}university{% else %}receipt{% endif %}"></i>
                        @switch($payment->payment_method)
                            @case('cash') Espèces @break
                            @case('mobile_money') Mobile Money @break
                            @case('bank_transfer') Virement @break
                            @case('check') Chèque @break
                        @endswitch
                    </td>
                    <td>
                        @if($payment->status === 'confirmed')
                            <span class="badge bg-success">✓ Confirmé</span>
                        @elseif($payment->status === 'pending')
                            <span class="badge bg-warning">⏳ En Attente</span>
                        @else
                            <span class="badge bg-danger">✗ Annulé</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('payments.show', $payment) }}" class="btn btn-sm btn-info btn-icon" title="Voir">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('payments.edit', $payment) }}" class="btn btn-sm btn-warning btn-icon" title="Éditer">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('payments.destroy', $payment) }}" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger btn-icon" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-light">
        {{ $payments->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
