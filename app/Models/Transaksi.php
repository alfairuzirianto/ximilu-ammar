<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    public const TIPE = [
        'masuk', 'keluar'
    ];

    public const STATUS = [
        'diproses', 'selesai', 'dibatalkan'
    ];

    protected $fillable = [
        'tipe',
        'pemasok_id',
        'total',
        'status',
        'tanggal',
        'keterangan'
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'tanggal' => 'date'
    ];

    public function pemasok(): BelongsTo
    {
        return $this->belongsTo(Pemasok::class, 'pemasok_id');
    }

    public function detailTransaksi(): HasMany
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }
}
