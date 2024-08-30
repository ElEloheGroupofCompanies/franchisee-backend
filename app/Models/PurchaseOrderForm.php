<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class PurchaseOrderForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_purchased',
        'time_purchased',
        'ordered_by',
        'business_name',
        'outlet',
        'address',
        'fc_without_breading',
        'fc_quantity',
        'with_spicy_flavor',
        'with_spicy_flavor_quantity',
        'hot_and_spicy',
        'hot_and_spicy_quantity',
        'malunggay',
        'malunggay_quantity',
        'image',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
