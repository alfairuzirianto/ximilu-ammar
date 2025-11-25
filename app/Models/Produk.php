<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    public const KATEGORI = [
        'makanan', 'minuman'
    ];

    public const SATUAN = [
        'pcs', 'cup', 'porsi'
    ];

    protected $fillable = [
        'nama',
        'kategori',
        'harga_dasar',
        'harga_jual',
        'satuan',
        'stok',
        'stok_minimum',
        'deskripsi',
        'gambar'
    ];

    protected $casts = [
        'harga_dasar' => 'decimal:2',
        'harga_jual' => 'decimal:2',
        'stok' => 'integer',
        'stok_minimum' => 'integer'
    ];

    public function detailTransaksi(): HasMany
    {
        return $this->hasMany(DetailTransaksi::class, 'produk_id');
    }

    public function isStokRendah(): bool
    {
        return $this->stok <= $this->stok_minimum;
    }
}
