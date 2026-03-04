<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'payment_system_id',
        'name',
        'code',
        'description',
        'fee_percentage',
        'fee_fixed',
        'is_active',
    ];

    protected $casts = [
        'fee_percentage' => 'decimal:2',
        'fee_fixed' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function system()
    {
        return $this->belongsTo(PaymentSystem::class, 'payment_system_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Calculer les frais pour un montant donné
     */
    public function calculateFees($amount)
    {
        $percentage = ($amount * ($this->fee_percentage / 100));
        return $percentage + $this->fee_fixed;
    }
}
