<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource (paginated)
     */
    public function index()
    {
        $payments = Payment::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $stats = [
            'total_amount' => Payment::sum('amount'),
            'total_count' => Payment::count(),
            'confirmed_count' => Payment::status('confirmed')->count(),
            'pending_count' => Payment::status('pending')->count(),
            'by_type' => [
                'tithe' => Payment::ofType('tithe')->sum('amount'),
                'donation' => Payment::ofType('donation')->sum('amount'),
                'offering' => Payment::ofType('offering')->sum('amount'),
                'service' => Payment::ofType('service')->sum('amount'),
            ],
            'by_method' => [
                'cash' => Payment::method('cash')->sum('amount'),
                'mobile_money' => Payment::method('mobile_money')->sum('amount'),
                'bank_transfer' => Payment::method('bank_transfer')->sum('amount'),
                'check' => Payment::method('check')->sum('amount'),
            ],
        ];

        return view('payments.index', compact('payments', 'stats'));
    }

    /**
     * Show the form for creating a new resource
     */
    public function create()
    {
        $types = Payment::getPaymentTypes();
        $methods = Payment::getPaymentMethods();
        
        return view('payments.create', compact('types', 'methods'));
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'payment_type' => 'required|in:tithe,donation,offering,service',
            'amount' => 'required|numeric|min:100',
            'currency' => 'required|in:XAF,EUR,USD',
            'payment_method' => 'required|in:cash,mobile_money,bank_transfer,check',
            'payment_date' => 'required|date',
            'reference_number' => 'unique:payments,reference_number',
            'description' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:500',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        Payment::create($validated);

        return redirect()->route('payments.index')
            ->with('success', '✅ Paiement enregistré avec succès!');
    }

    /**
     * Display the specified resource
     */
    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource
     */
    public function edit(Payment $payment)
    {
        $types = Payment::getPaymentTypes();
        $methods = Payment::getPaymentMethods();
        
        return view('payments.edit', compact('payment', 'types', 'methods'));
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
            'payment_type' => 'required|in:tithe,donation,offering,service',
            'amount' => 'required|numeric|min:100',
            'currency' => 'required|in:XAF,EUR,USD',
            'payment_method' => 'required|in:cash,mobile_money,bank_transfer,check',
            'payment_date' => 'required|date',
            'description' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:500',
        ]);

        $payment->update($validated);

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
        $query = Payment::with('user');

        if ($request->filled('payment_type')) {
            $query->ofType($request->payment_type);
        }

        if ($request->filled('status')) {
            $query->status($request->status);
        }

        if ($request->filled('payment_method')) {
            $query->method($request->payment_method);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('payment_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('payment_date', '<=', $request->end_date);
        }

        $payments = $query->orderBy('payment_date', 'desc')->paginate(20);

        $types = Payment::getPaymentTypes();
        $methods = Payment::getPaymentMethods();
        $statuses = Payment::getStatuses();

        return view('payments.report', compact('payments', 'types', 'methods', 'statuses'));
    }
}
