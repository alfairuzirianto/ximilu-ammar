<?php

namespace App\Livewire\Admin\Expense;

use App\Models\Expense;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ExpenseList extends Component
{
    use WithPagination;
    #[Url] public $search = '';
    #[Url] public $kategori = '';
    #[Url] public $status = '';
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingKategori() { $this->resetPage(); }
    public function updatingStatus() { $this->resetPage(); }

    public function confirmDelete($id)
    {
        $this->dispatch('confirm-delete', id: $id, message: 'Pengeluaran akan dihapus!');
    }

    #[\Livewire\Attributes\On('delete-confirmed')]
    public function delete($id)
    {
        Expense::find($id)?->delete();
        $this->dispatch('success', message: 'Pengeluaran berhasil dihapus!');
    }

    public function render()
    {
        $query = Expense::with('supplier');
        if ($this->search) $query->where('kode_invoice', 'like', "%{$this->search}%");
        if ($this->kategori) $query->where('kategori', $this->kategori);
        if ($this->status) $query->where('status', $this->status);

        return view('livewire.admin.expense.expense-list', [
            'expenses' => $query->latest('tanggal')->simplePaginate(10)
        ]);
    }

    public function invoicePdf($id)
    {
        $expense = Expense::with(['details.supplierItem', 'supplier', 'payments'])->findOrFail($id);
        
        $pdf = Pdf::loadView('pdf.expense-invoice', ['expense' => $expense]);
        return $pdf->download("invoice-{$expense->kode_invoice}.pdf");
    }
}
