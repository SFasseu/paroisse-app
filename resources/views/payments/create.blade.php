@extends('layouts.app')

@section('content')
<div class="row justify-content-center" style="min-height: calc(100vh - 150px);">
    <div class="col-lg-7 col-xl-6 my-auto">
        <div class="card shadow-lg border-0 church-form-container" style="border-radius: 2rem;">
            <div class="card-header text-white p-4" style="background: linear-gradient(135deg, #4169E1, #2F5233); border-radius: 2rem 2rem 0 0;">
                <h3 class="mb-0 text-center">
                    <i class="fas fa-plus-circle me-2"></i> Créer un Nouveau Paiement
                </h3>
            </div>

            <form action="{{ route('payments.store') }}" method="POST" class="church-form-body p-5">
                @csrf
                
                <div class="row">
                    <!-- Type d'Item -->
                    <div class="col-md-6 mb-3">
                        <label class="church-label">Type de Paiement</label>
                        <select name="item_type" id="item_type" class="form-control @error('item_type') is-invalid @enderror" required onchange="updateItems()">
                            <option value="">-- Sélectionner --</option>
                            <option value="mass_intention" @selected(old('item_type') === 'mass_intention')>Intention de Messe</option>
                            <option value="article" @selected(old('item_type') === 'article')>Article</option>
                            <option value="parking" @selected(old('item_type') === 'parking')>Parking</option>
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
                               min="1" value="{{ old('quantity', 1) }}" required onchange="updateAmount()">
                        @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Montant -->
                    <div class="col-md-6 mb-3">
                        <label class="church-label">Montant</label>
                        <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" 
                               step="0.01" min="100" placeholder="10000" value="{{ old('amount') }}" required>
                        @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Devise -->
                    <div class="col-md-6 mb-3">
                        <label class="church-label">Devise</label>
                        <select name="currency" class="form-control @error('currency') is-invalid @enderror" required>
                            <option value="XAF" selected>FCFA</option>
                            <option value="EUR">EUR</option>
                            <option value="USD">USD</option>
                        </select>
                        @error('currency') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Méthode de Paiement -->
                    <div class="col-md-6 mb-3">
                        <label class="church-label">Méthode de Paiement</label>
                        <select name="payment_method_id" class="form-control @error('payment_method_id') is-invalid @enderror" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach($methods as $method)
                                <option value="{{ $method->id }}" @selected(old('payment_method_id') == $method->id)>
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
                           value="{{ old('payment_date', now()->format('Y-m-d\TH:i')) }}" required>
                    @error('payment_date') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Numéro de Référence -->
                <div class="mb-3">
                    <label class="church-label">Numéro de Référence</label>
                    <input type="text" name="reference_number" class="form-control @error('reference_number') is-invalid @enderror" 
                           placeholder="REF-20260227-00001" value="{{ old('reference_number') }}" required>
                    @error('reference_number') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="church-label">Description (Optionnel)</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                              rows="2" placeholder="Détails supplémentaires...">{{ old('description') }}</textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Notes -->
                <div class="mb-3">
                    <label class="church-label">Notes (Optionnel)</label>
                    <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" 
                              rows="2" placeholder="Notes internes...">{{ old('notes') }}</textarea>
                    @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Boutons -->
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-success btn-icon btn-glow flex-grow-1">
                        <i class="fas fa-save me-2"></i> Enregistrer
                    </button>
                    <a href="{{ route('payments.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i> Annuler
                    </a>
                </div>
            </form>

            <script>
                const massIntentions = {!! json_encode($massIntentions->pluck('name', 'id')) !!};
                const articles = {!! json_encode($articles->pluck('name', 'id')) !!};
                const parkings = {!! json_encode($parkings->pluck('location', 'id')) !!};
                
                const itemPrices = {
                    mass_intention: {!! json_encode($massIntentions->pluck('suggested_amount', 'id')) !!},
                    article: {!! json_encode($articles->pluck('price', 'id')) !!},
                    parking: {!! json_encode($parkings->pluck('daily_rate', 'id')) !!},
                };

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
        </div>
    </div>
</div>
@endsection
