<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    const METODE = ['Tunai', 'QRIS', 'Transfer Bank', 'E-Wallet', 'Kartu Kredit'];
    
    protected $fillable = [
        'kode_invoice', 
        'tanggal', 
        'total',
        'metode'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'total' => 'decimal:2'
    ];

    public function details(): HasMany 
    { 
        return $this->hasMany(SaleDetail::class); 
    }
}
