<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    const METODE = ['Tunai', 'QRIS', 'Transfer Bank', 'E-Wallet', 'Kartu Kredit'];
    
    protected $fillable = [
        'expense_id', 
        'tanggal', 
        'nominal', 
        'metode', 
        'catatan'
    ];

    protected $casts = [
        'tanggal' => 'date', 
        'nominal' => 'decimal:2'
    ];

    public function expense(): BelongsTo 
    { 
        return $this->belongsTo(Expense::class); 
    }
}
