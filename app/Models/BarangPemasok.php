<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BarangPemasok extends Model
{
    use HasFactory;

    protected $table = 'barang_pemasok';

    public const SATUAN = [
        'pcs', 'cup', 'porsi'
    ];

    protected $fillable = [
        'pemasok_id',
        'nama_item',
        'satuan',
        'harga'
    ];

    protected $casts = [
        'harga' => 'decimal:2'
    ];

    public function pemasok(): BelongsTo
    {
        return $this->belongsTo(Pemasok::class, 'pemasok_id');
    }

    public function detailTransaksi(): HasMany
    {
        return $this->hasMany(DetailTransaksi::class, 'barang_pemasok_id');
    }
}
