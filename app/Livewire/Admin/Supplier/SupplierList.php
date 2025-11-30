<?php

namespace App\Livewire\Admin\Supplier;

use App\Models\Supplier;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class SupplierList extends Component
{
    use WithPagination;
    #[Url()] public $search = '';
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch() { $this->resetPage(); }

    public function confirmDelete($id)
    {
        $this->dispatch('confirm-delete', id: $id, message: 'Pemasok akan dihapus!');
    }

    #[On('delete-confirmed')]
    public function delete($id)
    {
        Supplier::find($id)?->delete();
        $this->dispatch('success', message: 'Pemasok berhasil dihapus!');
    }

    public function render()
    {
        $query = Supplier::withCount('items');
        if ($this->search) $query->where('nama', 'like', "%{$this->search}%");

        return view('livewire.admin.supplier.supplier-list', [
            'suppliers' => $query->latest()->simplePaginate(9)
        ]);
    }
}
