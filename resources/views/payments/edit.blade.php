@extends('layouts.app')

@section('content')
<div class="church-hero mb-5">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <h1 class="display-5">✏️ Modifier le Paiement</h1>
            <p class="lead text-white-50">Ref: <strong>{{ $payment->reference_number }}</strong></p>
        </div>
        <div class="col-lg-4 text-right">
            <a href="{{ route('payments.show', $payment) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>
</div>

@if($payment->status === 'confirmed')
<div class="alert alert-warning d-flex align-items-center mb-4">
    <i class="fas fa-exclamation-triangle me-3 fs-4"></i>
    <div>
        <strong>Attention!</strong> Ce paiement est confirmé. Seules certaines informations peuvent être modifiées.
    </div>
</div>
@endif

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-lg border-0 church-form-container">
            <div class="card-header text-white" style="background: linear-gradient(135deg, #4169E1, #2F5233);">
                <h5 class="mb-0"><i class="fas fa-pencil-alt me-2"></i> Formulaire de Modification</h5>
            </div>

            <form action="{{ route('payments.update', $payment) }}" method="POST" class="church-form-body p-5">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Type d'Item -->
                    <div class="col-md-6 mb-3">
                        <label class="church-label">Type de Paiement</label>
                        @php
                            $currentItem = $payment->items->first();
                            $currentType = null;
                            if ($currentItem && $currentItem->itemable_type === 'App\Models\MassIntention') {
                                $currentType = 'mass_intention';
                            } elseif ($currentItem && $currentItem->itemable_type === 'App\Models\Article') {
                                $currentType = 'article';
                            } elseif ($currentItem && $currentItem->itemable_type === 'App\Models\Parking') {
                                $currentType = 'parking';
                            }
                        @endphp
                        <select name="item_type" id="item_type" class="form-control @error('item_type') is-invalid @enderror" required onchange="updateItems()">
                            <option value="">-- Sélectionner --</option>
                            <option value="mass_intention" @selected($currentType === 'mass_intention')>Intention de Messe</option>
                            <option value="article" @selected($currentType === 'article')>Article</option>
                            <option value="parking" @selected($currentType === 'parking')>Parking</option>
                        </select>
                        @error('item_type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Sélection Item -->
                    <div class="col-md-6 mb-3">
                        <label class="church-label">Sélectionner l'Item</label>
                        <select name="item_id" id="item_id" class="form-control @error('item_id') is-invalid @enderror" required onchange="updateAmount()">
                            <option value="">-- Sélectionner --</option>
                        </select>
                        @error('item_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Quantité -->
                    <div class="col-md-6 mb-3">
                        <label class="church-label">Quantité</label>
                        <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" 
                               min="1" value="{{ $currentItem->quantity ?? 1 }}" required onchange="updateAmount()">
                        @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Montant -->
                    <div class="col-md-6 mb-3">
                        <label class="church-label">Montant</label>
                        <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" 
                               step="0.01" min="100" placeholder="10000" value="{{ $payment->amount }}" required>
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
                        <select name="payment_method_id" class="form-control @error('payment_method_id') is-invalid @enderror" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach($methods as $method)
                                <option value="{{ $method->id }}" @selected($payment->payment_method_id == $method->id)>
                                    {{ $method->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('payment_method_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Date du Paiement -->
                <div class="mb-3">
                    <label class="church-label">Date du Paiement</label>
                    <input type="datetime-local" name="payment_date" class="form-control @error('payment_date') is-invalid @enderror" 
                           value="{{ $payment->payment_date->format('Y-m-d\TH:i') }}" required>
                    @error('payment_date') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="church-label">Description (Optionnel)</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                              rows="2" placeholder="Détails supplémentaires...">{{ $payment->description }}</textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Notes -->
                <div class="mb-3">
                    <label class="church-label">Notes (Optionnel)</label>
                    <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" 
                              rows="2" placeholder="Notes internes...">{{ $payment->notes }}</textarea>
                    @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Statut Info -->
                <div class="alert alert-info">
                    <strong>Statut Actuel:</strong> 
                    @if($payment->status === 'confirmed')
                        <span class="badge bg-success">✓ Confirmé</span>
                    @elseif($payment->status === 'pending')
                        <span class="badge bg-warning text-dark">⏳ En Attente</span>
                    @else
                        <span class="badge bg-danger">✗ Annulé</span>
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

<script>
    const massIntentions = {!! json_encode($massIntentions->pluck('name', 'id')) !!};
    const articles = {!! json_encode($articles->pluck('name', 'id')) !!};
    const parkings = {!! json_encode($parkings->pluck('location', 'id')) !!};
    
    const itemPrices = {
        mass_intention: {!! json_encode($massIntentions->pluck('suggested_amount', 'id')) !!},
        article: {!! json_encode($articles->pluck('price', 'id')) !!},
        parking: {!! json_encode($parkings->pluck('daily_rate', 'id')) !!},
    };

    // Charger les items au démarrage
    document.addEventListener('DOMContentLoaded', function() {
        const currentType = document.getElementById('item_type').value;
        if (currentType) {
            updateItems();
            const currentItemId = "{{ $currentItem->itemable_id ?? '' }}";
            if (currentItemId) {
                setTimeout(() => {
                    document.getElementById('item_id').value = currentItemId;
                }, 100);
            }
        }
    });

    function updateItems() {
        const type = document.getElementById('item_type').value;
        const itemSelect = document.getElementById('item_id');
        itemSelect.innerHTML = '<option value="">-- Sélectionner --</option>';
        
        let items = {};
        if (type === 'mass_intention') items = massIntentions;
        else if (type === 'article') items = articles;
        else if (type === 'parking') items = parkings;
        
        for (const [id, name] of Object.entries(items)) {
            const option = document.createElement('option');
            option.value = id;
            option.text = name;
            itemSelect.appendChild(option);
        }
    }

    function updateAmount() {
        const type = document.getElementById('item_type').value;
        const itemId = document.getElementById('item_id').value;
        const quantity = document.getElementById('quantity').value || 1;
        
        if (type && itemId && itemPrices[type] && itemPrices[type][itemId]) {
            const unitPrice = itemPrices[type][itemId];
            const totalAmount = unitPrice * quantity;
            document.getElementById('amount').value = totalAmount;
        }
    }
</script>
@endsection
