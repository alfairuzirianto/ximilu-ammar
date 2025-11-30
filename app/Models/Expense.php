<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Expense extends Model
{
    const KATEGORI = ['Pembelian Bahan', 'Operasional', 'Gaji', 'Utilitas', 'Marketing', 'Lainnya'];
    const STATUS = ['belum lunas' => 'Belum Lunas', 'lunas' => 'Lunas', 'dibatalkan' => 'Dibatalkan'];

    protected $fillable = [
        'kode_invoice', 
        'tanggal', 
        'kategori', 
        'supplier_id', 
        'total', 
        'status'
    ];

    protected $casts = [
        'tanggal' => 'date', 'total' => 'decimal:2'
    ];

    public function supplier(): BelongsTo 
    { 
        return $this->belongsTo(Supplier::class); 
    }

    public function details(): HasMany 
    { 
        return $this->hasMany(ExpenseDetail::class); 
    }

    public function payments(): HasMany 
    {
        return $this->hasMany(Payment::class); 
    }

    public function totalPaid()
    {
        return $this->payments()->sum('nominal');
    }

    public function sisaTagihan()
    {
        return $this->total - $this->totalPaid();
    }

    public function isLunas()
    {
        return $this->sisaTagihan() <= 0;
    }
}
