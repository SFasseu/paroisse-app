<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentItem extends Model
{
    protected $fillable = [
        'payment_id',
        'itemable_type',
        'itemable_id',
        'amount',
        'quantity',
        'description',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function itemable()
    {
        return $this->morphTo();
    }
}
