<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'payment_method_id',
        'amount',
        'currency',
        'status',
        'description',
        'reference_number',
        'payment_date',
        'confirmed_at',
        'confirmed_by',
        'notes',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'confirmed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the user associated with the payment
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the payment method associated with the payment
     */
    public function method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    /**
     * Get the payment system through method
     */
    public function system()
    {
        return $this->through($this->method())->has(PaymentSystem::class, 'payment_systems', 'id', 'payment_system_id');
    }

    /**
     * Get all payment items for this payment
     */
    public function items()
    {
        return $this->hasMany(PaymentItem::class);
    }

    /**
     * Get all mass intentions for this payment
     */
    public function massIntentions()
    {
        return $this->hasManyThrough(
            MassIntention::class,
            PaymentItem::class,
            'payment_id',    // Foreign key on PaymentItem table
            'id',            // Foreign key on MassIntention table
            'id',            // Local key on Payment table
            'itemable_id'    // Local key on PaymentItem table
        )->where('payment_items.itemable_type', MassIntention::class);
    }

    /**
     * Get all articles for this payment
     */
    public function articles()
    {
        return $this->hasManyThrough(
            Article::class,
            PaymentItem::class,
            'payment_id',
            'id',
            'id',
            'itemable_id'
        )->where('payment_items.itemable_type', Article::class);
    }

    /**
     * Get all parking for this payment
     */
    public function parkingItems()
    {
        return $this->hasManyThrough(
            Parking::class,
            PaymentItem::class,
            'payment_id',
            'id',
            'id',
            'itemable_id'
        )->where('payment_items.itemable_type', Parking::class);
    }

    /**
     * Scope to filter by payment type (based on itemable_type)
     */
    public function scopeOfType($query, $type)
    {
        return $query->whereHas('items', function ($q) use ($type) {
            $q->where('itemable_type', $type);
        });
    }

    /**
     * Get the payment type(s) based on items
     */
    public function getPaymentType()
    {
        $types = $this->items->pluck('itemable_type')->unique()->toArray();
        
        if (empty($types)) {
            return 'unknown';
        }

        return match (count($types)) {
            1 => match ($types[0]) {
                MassIntention::class => 'mass_intention',
                Article::class => 'article',
                Parking::class => 'parking',
                default => 'unknown',
            },
            default => 'mixed', // Si le paiement contient plusieurs types
        };
    }

    /**
     * Get payment types (now based on items)
     */
    public static function getPaymentTypes()
    {
        return [
            'mass_intention' => 'Intention de Messe',
            'article' => 'Article',
            'parking' => 'Parking',
            'mixed' => 'Paiement Multiple',
        ];
    }

    /**
     * Scope to filter by payment type
     * Kept for backward compatibility - now filters by itemable_type
     */
    public function scopeByType($query, $type)
    {
        $typeMap = [
            'tithe' => MassIntention::class,
            'donation' => MassIntention::class,
            'offering' => MassIntention::class,
            'service' => MassIntention::class,
            'mass_intention' => MassIntention::class,
            'article' => Article::class,
            'parking' => Parking::class,
        ];

        $modelClass = $typeMap[$type] ?? null;
        
        if (!$modelClass) {
            return $query;
        }

        return $query->whereHas('items', function ($q) use ($modelClass) {
            $q->where('itemable_type', $modelClass);
        });
    }

    /**
     * Scope to filter by status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to filter by payment method
     */
    public function scopeByMethod($query, $methodId)
    {
        return $query->where('payment_method_id', $methodId);
    }

    /**
     * Get total amount for filtered payments
     */
    public static function getTotalAmount($filters = [])
    {
        $query = self::query();
        
        if (!empty($filters['type'])) $query->byType($filters['type']);
        if (!empty($filters['status'])) $query->status($filters['status']);
        if (!empty($filters['method'])) $query->byMethod($filters['method']);
        
        return $query->sum('amount');
    }

    /**
     * Get payment methods (from database)
     */
    public static function getPaymentMethods()
    {
        return PaymentMethod::where('is_active', true)->get();
    }

    /**
     * Get statuses
     */
    public static function getStatuses()
    {
        return ['pending', 'confirmed', 'cancelled'];
    }
}


