<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupplierItem extends Model
{
    const SATUAN = ['kg', 'gram', 'liter', 'ml', 'pcs', 'box', 'pack', 'karton'];
    
    protected $fillable = [
        'supplier_id', 
        'nama', 
        'satuan', 
        'harga_satuan'
    ];

    protected $casts = [
        'harga_satuan' => 'decimal:2'
    ];

    public function supplier(): BelongsTo 
    { 
        return $this->belongsTo(Supplier::class); 
    }

    public function expenseDetails(): HasMany 
    { 
        return $this->hasMany(ExpenseDetail::class); 
    }
}
