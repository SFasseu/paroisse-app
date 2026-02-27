@extends('layouts.app')

@section('content')
<div class="church-hero mb-4">
    <h1 class="display-5">📊 Rapport des Paiements</h1>
    <p class="lead text-white-50">Filtrez et analysez les paiements par critères</p>
</div>

<!-- Filtres -->
<div class="card shadow-lg border-0 mb-4">
    <div class="card-header text-white" style="background: linear-gradient(135deg, #4169E1, #2F5233);">
        <h5 class="mb-0">
            <i class="fas fa-filter me-2"></i> Filtres de Recherche
        </h5>
    </div>

    <form method="GET" action="{{ route('payments.report') }}" class="p-4">
        <div class="row">
            <!-- Type de Paiement -->
            <div class="col-md-3 mb-3">
                <label class="church-label">Type de Paiement</label>
                <select name="payment_type" class="form-control">
                    <option value="">-- Tous --</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" @selected(request('payment_type') === $type)>
                            {{ ucfirst($type) }}
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
                <select name="payment_method" class="form-control">
                    <option value="">-- Tous --</option>
                    @foreach($methods as $method)
                        <option value="{{ $method }}" @selected(request('payment_method') === $method)>
                            {{ ucfirst(str_replace('_', ' ', $method)) }}
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
    <div class="col-md-4">
        <div class="card card-hover shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted">Total des Paiements</h6>
                <h3 class="text-church-primary">
                    {{ $payments->total() }}
                </h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-hover shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted">Montant Total</h6>
                <h3 class="text-church-primary">
                    {{ number_format($payments->sum('amount') ?? 0, 0) }} FCFA
                </h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-hover shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted">Montant Moyen</h6>
                <h3 class="text-church-primary">
                    {{ number_format(($payments->sum('amount') ?? 0) / max($payments->count(), 1), 0) }} FCFA
                </h3>
            </div>
        </div>
    </div>
</div>

<!-- Table des Résultats -->
<div class="card shadow-lg border-0">
    <div class="card-header text-white" style="background: linear-gradient(135deg, #4169E1, #2F5233);">
        <h5 class="mb-0">📋 Résultats du Rapport</h5>
    </div>

    @if($payments->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead style="background: linear-gradient(135deg, #4169E1, #2F5233); color: white;">
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Montant</th>
                    <th>Méthode</th>
                    <th>Statut</th>
                    <th>Actions</th>
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
                    <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</td>
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
                        <a href="{{ route('payments.show', $payment) }}" class="btn btn-sm btn-info btn-icon">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer bg-light">
        {{ $payments->links('pagination::bootstrap-4') }}
    </div>
    @else
    <div class="card-body">
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            Aucun paiement ne correspond à vos critères de filtrage.
        </div>
    </div>
    @endif
</div>
@endsection
