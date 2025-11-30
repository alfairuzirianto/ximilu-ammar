<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $fillable = [
        'nama',
        'telepon',
        'email',
        'alamat'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(SupplierItem::class, 'supplier_id');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'supplier_id');
    }
}
