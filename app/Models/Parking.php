<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parking extends Model
{
    use SoftDeletes;

    protected $table = 'parking';
    protected $fillable = [
        'location',
        'total_spaces',
        'available_spaces',
        'hourly_rate',
        'daily_rate',
        'currency',
        'is_active',
    ];

    protected $casts = [
        'hourly_rate' => 'decimal:2',
        'daily_rate' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function paymentItems()
    {
        return $this->morphMany(PaymentItem::class, 'itemable');
    }

    public function payments()
    {
        return $this->hasManyThrough(Payment::class, PaymentItem::class, 'itemable_id', 'id', 'id', 'payment_id')
            ->where('itemable_type', self::class);
    }
}
