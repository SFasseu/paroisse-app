<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentItem;
use App\Models\PaymentMethod;
use App\Models\MassIntention;
use App\Models\Article;
use App\Models\Parking;
use Illuminate\Http\Request;
use Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource (paginated)
     */
    public function index()
    {
        $payments = Payment::with(['user', 'items'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $stats = [
            'total_amount' => Payment::sum('amount'),
            'total_count' => Payment::count(),
            'confirmed_count' => Payment::status('confirmed')->count(),
            'pending_count' => Payment::status('pending')->count(),
            'by_type' => [],
        ];

        return view('payments.index', compact('payments', 'stats'));
    }

    /**
     * Show the form for creating a new resource
     */
    public function create()
    {
        $massIntentions = MassIntention::where('is_active', true)->get();
        $articles = Article::where('is_active', true)->get();
        $parkings = Parking::where('is_active', true)->get();
        $methods = Payment::getPaymentMethods();
        
        return view('payments.create', compact('massIntentions', 'articles', 'parkings', 'methods'));
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_type' => 'required|in:mass_intention,article,parking',
            'item_id' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1',
            'amount' => 'required|numeric|min:100',
            'currency' => 'required|in:XAF,EUR,USD',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'payment_date' => 'required|date',
            'reference_number' => 'unique:payments,reference_number',
            'description' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:500',
        ]);

        // Créer le paiement
        $payment = Payment::create([
            'user_id' => Auth::id(),
            'payment_method_id' => $validated['payment_method_id'],
            'amount' => $validated['amount'],
            'currency' => $validated['currency'],
            'status' => 'pending',
            'description' => $validated['description'],
            'reference_number' => $validated['reference_number'],
            'payment_date' => $validated['payment_date'],
            'notes' => $validated['notes'],
        ]);

        // Ajouter l'item de paiement
        $itemableType = match($validated['item_type']) {
            'mass_intention' => MassIntention::class,
            'article' => Article::class,
            'parking' => Parking::class,
        };

        PaymentItem::create([
            'payment_id' => $payment->id,
            'itemable_type' => $itemableType,
            'itemable_id' => $validated['item_id'],
            'amount' => $validated['amount'],
            'quantity' => $validated['quantity'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('payments.index')
            ->with('success', '✅ Paiement enregistré avec succès!');
    }

    /**
     * Display the specified resource
     */
    public function show(Payment $payment)
    {
        $payment->load(['user', 'method.system', 'items']);
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource
     */
    public function edit(Payment $payment)
    {
        if ($payment->status === 'confirmed') {
            return redirect()->route('payments.show', $payment)
                ->with('error', '❌ Les paiements confirmés ne peuvent pas être modifiés');
        }

        $payment->load(['items']);
        $massIntentions = MassIntention::where('is_active', true)->get();
        $articles = Article::where('is_active', true)->get();
        $parkings = Parking::where('is_active', true)->get();
        $methods = PaymentMethod::where('is_active', true)->with('system')->get();
        
        return view('payments.edit', compact('payment', 'massIntentions', 'articles', 'parkings', 'methods'));
    }

    /**
     * Update the specified resource in storage
     */
    public function update(Request $request, Payment $payment)
    {
        if ($payment->status === 'confirmed') {
            return redirect()->back()
                ->with('error', '❌ Les paiements confirmés ne peuvent pas être modifiés');
        }

        $validated = $request->validate([
            'item_type' => 'required|in:mass_intention,article,parking',
            'item_id' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1',
            'amount' => 'required|numeric|min:100',
            'currency' => 'required|in:XAF,EUR,USD',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'payment_date' => 'required|date',
            'description' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:500',
        ]);

        // Mettre à jour le paiement
        $payment->update([
            'payment_method_id' => $validated['payment_method_id'],
            'amount' => $validated['amount'],
            'currency' => $validated['currency'],
            'payment_date' => $validated['payment_date'],
            'description' => $validated['description'],
            'notes' => $validated['notes'],
        ]);

        // Mettre à jour l'item de paiement
        $itemableType = match($validated['item_type']) {
            'mass_intention' => MassIntention::class,
            'article' => Article::class,
            'parking' => Parking::class,
        };

        // Supprimer les anciens items et créer les nouveaux
        $payment->items()->delete();
        PaymentItem::create([
            'payment_id' => $payment->id,
            'itemable_type' => $itemableType,
            'itemable_id' => $validated['item_id'],
            'amount' => $validated['amount'],
            'quantity' => $validated['quantity'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('payments.show', $payment)
            ->with('success', '✅ Paiement mis à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', '✅ Paiement supprimé avec succès!');
    }

    /**
     * Confirm a payment
     */
    public function confirm(Payment $payment)
    {
        if ($payment->status === 'confirmed') {
            return redirect()->back()
                ->with('warning', '⚠️ Ce paiement est déjà confirmé');
        }

        $payment->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
            'confirmed_by' => Auth::id(),
        ]);

        return redirect()->route('payments.show', $payment)
            ->with('success', '✅ Paiement confirmé avec succès!');
    }

    /**
     * Cancel a payment
     */
    public function cancel(Payment $payment)
    {
        if ($payment->status === 'cancelled') {
            return redirect()->back()
                ->with('warning', '⚠️ Ce paiement est déjà annulé');
        }

        $payment->update(['status' => 'cancelled']);

        return redirect()->route('payments.show', $payment)
            ->with('success', '✅ Paiement annulé avec succès!');
    }

    /**
     * Generate report with filters
     */
    public function report(Request $request)
    {
        $query = Payment::with(['user', 'method.system', 'items']);

        // Filtrer par type d'item (intention de messe, article, parking)
        if ($request->filled('item_type')) {
            $itemType = match($request->item_type) {
                'mass_intention' => MassIntention::class,
                'article' => Article::class,
                'parking' => Parking::class,
                default => null,
            };
            
            if ($itemType) {
                $query->whereHas('items', function ($q) use ($itemType) {
                    $q->where('itemable_type', $itemType);
                });
            }
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_method_id')) {
            $query->where('payment_method_id', $request->payment_method_id);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('payment_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('payment_date', '<=', $request->end_date);
        }

        // Cloner la requête pour calculer les statistiques AVANT pagination
        $statsQuery = clone $query;
        
        // Calculer les statistiques basées sur les filtres
        $stats = [
            'total_amount' => $statsQuery->sum('amount'),
            'total_count' => $statsQuery->count(),
            'confirmed_amount' => (clone $statsQuery)->where('status', 'confirmed')->sum('amount'),
            'confirmed_count' => (clone $statsQuery)->where('status', 'confirmed')->count(),
            'pending_amount' => (clone $statsQuery)->where('status', 'pending')->sum('amount'),
            'pending_count' => (clone $statsQuery)->where('status', 'pending')->count(),
        ];

        // Paginer après les statistiques
        $payments = $query->orderBy('payment_date', 'desc')->paginate(20);

        $types = Payment::getPaymentTypes();
        $methods = PaymentMethod::where('is_active', true)->with('system')->get();
        $statuses = Payment::getStatuses();

        return view('payments.report', compact('payments', 'types', 'methods', 'statuses', 'stats'));
    }
}
