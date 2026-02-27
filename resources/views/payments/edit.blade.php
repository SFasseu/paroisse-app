@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0 church-form-container">
            <div class="card-header text-white" style="background: linear-gradient(135deg, #4169E1, #2F5233);">
                <h4 class="mb-0">
                    <i class="fas fa-edit me-2"></i> Modifier le Paiement #{{ $payment->id }}
                </h4>
            </div>

            @if($payment->status === 'confirmed')
            <div class="alert alert-warning m-3">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Note:</strong> Ce paiement est confirmé. Seules certaines informations peuvent être modifiées.
            </div>
            @endif

            <form action="{{ route('payments.update', $payment) }}" method="POST" class="church-form-body">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Type de Paiement -->
                    <div class="col-md-6 mb-3">
                        <label class="church-label">Type de Paiement</label>
                        <select name="payment_type" class="form-control @error('payment_type') is-invalid @enderror" 
                                required {{ $payment->status === 'confirmed' ? 'disabled' : '' }}>
                            @foreach($types as $type)
                                <option value="{{ $type }}" @selected($payment->payment_type === $type)>
                                    {{ ucfirst($type) }}
                                </option>
                            @endforeach
                        </select>
                        @error('payment_type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Montant -->
                    <div class="col-md-6 mb-3">
                        <label class="church-label">Montant</label>
                        <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" 
                               step="0.01" min="100" value="{{ $payment->amount }}" 
                               required {{ $payment->status === 'confirmed' ? 'disabled' : '' }}>
                        @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Devise -->
                    <div class="col-md-6 mb-3">
                        <label class="church-label">Devise</label>
                        <select name="currency" class="form-control @error('currency') is-invalid @enderror" required>
                            <option value="XAF" @selected($payment->currency === 'XAF')>FCFA</option>
                            <option value="EUR" @selected($payment->currency === 'EUR')>EUR</option>
                            <option value="USD" @selected($payment->currency === 'USD')>USD</option>
                        </select>
                        @error('currency') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Méthode de Paiement -->
                    <div class="col-md-6 mb-3">
                        <label class="church-label">Méthode de Paiement</label>
                        <select name="payment_method" class="form-control @error('payment_method') is-invalid @enderror" 
                                required {{ $payment->status === 'confirmed' ? 'disabled' : '' }}>
                            @foreach($methods as $method)
                                <option value="{{ $method }}" @selected($payment->payment_method === $method)>
                                    {{ ucfirst(str_replace('_', ' ', $method)) }}
                                </option>
                            @endforeach
                        </select>
                        @error('payment_method') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Date du Paiement -->
                <div class="mb-3">
                    <label class="church-label">Date du Paiement</label>
                    <input type="datetime-local" name="payment_date" class="form-control @error('payment_date') is-invalid @enderror" 
                           value="{{ $payment->payment_date->format('Y-m-d\TH:i') }}" 
                           required {{ $payment->status === 'confirmed' ? 'disabled' : '' }}>
                    @error('payment_date') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="church-label">Description (Optionnel)</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                              rows="2">{{ $payment->description }}</textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Notes -->
                <div class="mb-3">
                    <label class="church-label">Notes (Optionnel)</label>
                    <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" 
                              rows="2">{{ $payment->notes }}</textarea>
                    @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Statut (info) -->
                <div class="alert alert-info">
                    <strong>Statut Actuel:</strong> 
                    @if($payment->status === 'confirmed')
                        <span class="badge bg-success">Confirmé</span>
                    @elseif($payment->status === 'pending')
                        <span class="badge bg-warning">En Attente</span>
                    @else
                        <span class="badge bg-danger">Annulé</span>
                    @endif
                </div>

                <!-- Boutons -->
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-success btn-icon btn-glow flex-grow-1">
                        <i class="fas fa-save me-2"></i> Enregistrer
                    </button>
                    <a href="{{ route('payments.show', $payment) }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
