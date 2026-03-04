<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity_available',
        'currency',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
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
