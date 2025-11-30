<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    #[Url()] 
    public $search = '';
    
    #[Url] 
    public $kategori = '';

    public function updatingSearch() 
    { 
        $this->resetPage(); 
    }

    public function updatingKategori() 
    { 
        $this->resetPage(); 
    }

    public function confirmDelete($id)
    {
        $this->dispatch('confirm-delete', id: $id, message: 'Produk akan dihapus!');
    }

    #[On('delete-confirmed')]
    public function delete($id)
    {
        $product = Product::find($id);
        if ($product) {
            if ($product->gambar) Storage::disk('public')->delete($product->gambar);
            $product->delete();
            $this->dispatch('success', message: 'Produk berhasil dihapus!');
        }
    }

    public function render()
    {
        $query = Product::query();
        if ($this->search) $query->where('nama', 'like', "%{$this->search}%");
        if ($this->kategori) $query->where('kategori', $this->kategori);

        return view('livewire.admin.product.product-list', [
            'products' => $query->latest()->simplePaginate(9),
            'categories' => Product::KATEGORI
        ]);
    }
}
