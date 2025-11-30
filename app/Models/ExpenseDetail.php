<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpenseDetail extends Model
{
    protected $fillable = [
        'expense_id', 
        'supplier_item_id', 
        'deskripsi', 
        'jumlah', 
        'subtotal'
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'subtotal' => 'decimal:2'
    ];

    public function expense(): BelongsTo 
    { 
        return $this->belongsTo(Expense::class); 
    }

    public function supplierItem(): BelongsTo 
    { 
        return $this->belongsTo(SupplierItem::class); 
    }
}
