<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads;

    public $productId, $nama, $kategori, $satuan, $harga_satuan, $deskripsi, $gambar, $existingGambar;

    public function mount($id)
    {
        $product = Product::findOrFail($id);
        $this->productId = $product->id;
        $this->nama = $product->nama;
        $this->kategori = $product->kategori;
        $this->satuan = $product->satuan;
        $this->harga_satuan = $product->harga_satuan;
        $this->deskripsi = $product->deskripsi;
        $this->existingGambar = $product->gambar;
    }

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

    public function update()
    {
        $validated = $this->validate();

        $product = Product::find($this->productId);

        if ($this->gambar) {
            // Delete old image
            if ($this->existingGambar && $this->existingGambar !== $validated['gambar']) {
                Storage::disk('public')->delete($this->existingGambar);
            }
            $validated['gambar'] = $this->gambar->store('products', 'public');
        } else {
            // Preserve existing image
            $validated['gambar'] = $this->existingGambar;
        }

        $product->update($validated);
        $this->dispatch('success', message: 'Produk berhasil diperbarui!');
        return $this->redirect(route('admin.products.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.product.product-form');
    }
}
