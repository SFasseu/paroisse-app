<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'payment_type',
        'amount',
        'currency',
        'payment_method',
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
     * Scope to filter by payment type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('payment_type', $type);
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
    public function scopeMethod($query, $method)
    {
        return $query->where('payment_method', $method);
    }

    /**
     * Get total amount for filtered payments
     */
    public static function getTotalAmount($filters = [])
    {
        $query = self::query();
        
        if (!empty($filters['type'])) $query->ofType($filters['type']);
        if (!empty($filters['status'])) $query->status($filters['status']);
        if (!empty($filters['method'])) $query->method($filters['method']);
        
        return $query->sum('amount');
    }

    /**
     * Get payment types
     */
    public static function getPaymentTypes()
    {
        return ['tithe', 'donation', 'offering', 'service'];
    }

    /**
     * Get payment methods
     */
    public static function getPaymentMethods()
    {
        return ['cash', 'mobile_money', 'bank_transfer', 'check'];
    }

    /**
     * Get statuses
     */
    public static function getStatuses()
    {
        return ['pending', 'confirmed', 'cancelled'];
    }
}
