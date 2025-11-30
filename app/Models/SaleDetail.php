<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleDetail extends Model
{
    protected $fillable = [
        'sale_id',
        'product_id',
        'jumlah',
        'subtotal'
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'subtotal' => 'decimal:2'
    ];

    public function sale(): BelongsTo 
    { 
        return $this->belongsTo(Sale::class); 
    }

    public function product(): BelongsTo 
    { 
        return $this->belongsTo(Product::class); 
    }
}
