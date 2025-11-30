<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    const KATEGORI = [
        'Makanan', 'Minuman'
    ];

    const SATUAN = [
        'pcs', 'porsi'
    ];

    protected $fillable = [
        'nama',
        'kategori',
        'satuan',
        'harga_satuan',
        'deskripsi',
        'gambar'
    ];

    protected $casts = [
        'harga_satuan' => 'decimal:2',
    ];

    public function saleDetails(): HasMany
    {
        return $this->hasMany(SaleDetail::class, 'product_id');
    }
}
