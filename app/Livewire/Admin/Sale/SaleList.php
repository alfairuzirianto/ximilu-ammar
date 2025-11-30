<?php

namespace App\Livewire\Admin\Sale;

use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class SaleList extends Component
{
    use WithPagination;
    #[Url] public $search = '';
    #[Url] public $metode = '';
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingMetode() { $this->resetPage(); }

    public function confirmDelete($id)
    {
        $this->dispatch('confirm-delete', id: $id, message: 'Penjualan akan dihapus!');
    }

    #[\Livewire\Attributes\On('delete-confirmed')]
    public function delete($id)
    {
        Sale::find($id)?->delete();
        $this->dispatch('success', message: 'Penjualan berhasil dihapus!');
    }

    public function render()
    {
        $query = Sale::query();
        if ($this->search) $query->where('kode_invoice', 'like', "%{$this->search}%");
        if ($this->metode) $query->where('metode', $this->metode);

        return view('livewire.admin.sale.sale-list', [
            'sales' => $query->latest('tanggal')->paginate(10)
        ]);
    }
}
