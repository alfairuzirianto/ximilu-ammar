<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $nama, $kategori, $satuan, $harga_satuan, $deskripsi, $gambar, $existingGambar;

    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'kategori' => 'required|in:' . implode(',', Product::KATEGORI),
            'satuan' => 'required|in:' . implode(',', Product::SATUAN),
            'harga_satuan' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->gambar) {
            $validated['gambar'] = $this->gambar->store('products', 'public');
        }

        Product::create($validated);
        $this->dispatch('success', message: 'Produk berhasil ditambahkan!');
        return $this->redirect(route('admin.products.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.product.product-form');
    }
}
