<?php

namespace App\Livewire\Admin\Expense;

use App\Models\Expense;
use App\Models\Supplier;
use App\Models\SupplierItem;
use Livewire\Component;

class ExpenseEdit extends Component
{
    public $expenseId, $kode_invoice, $tanggal, $kategori, $supplier_id, $status;
    public $details = [];
    public $supplierItems = [];

    public function mount($id)
    {
        $expense = Expense::with('details')->findOrFail($id);
        $this->expenseId = $expense->id;
        $this->kode_invoice = $expense->kode_invoice;
        $this->tanggal = $expense->tanggal->format('Y-m-d');
        $this->kategori = $expense->kategori;
        $this->supplier_id = $expense->supplier_id;
        $this->status = $expense->status;
        
        foreach ($expense->details as $detail) {
            $this->details[] = [
                'supplier_item_id' => $detail->supplier_item_id,
                'deskripsi' => $detail->deskripsi,
                'jumlah' => $detail->jumlah,
                'subtotal' => $detail->subtotal,
            ];
        }
        
        $this->loadSupplierItems();
    }

    public function loadSupplierItems()
    {
        if ($this->supplier_id) {
            $this->supplierItems = SupplierItem::where('supplier_id', $this->supplier_id)->get();
        }
    }

    public function addDetail()
    {
        $this->details[] = ['supplier_item_id' => '', 'deskripsi' => '', 'jumlah' => 1, 'subtotal' => 0];
    }

    public function removeDetail($index)
    {
        unset($this->details[$index]);
        $this->details = array_values($this->details);
    }

    public function calculateSubtotal($index)
    {
        $detail = $this->details[$index];
        if ($detail['supplier_item_id']) {
            $item = SupplierItem::find($detail['supplier_item_id']);
            $this->details[$index]['subtotal'] = $item->harga_satuan * $detail['jumlah'];
        }
    }

    public function update()
    {
        $this->validate([
            'tanggal' => 'required|date',
            'kategori' => 'required',
            'status' => 'required',
        ]);

        $total = collect($this->details)->sum('subtotal');

        $expense = Expense::find($this->expenseId);
        $expense->update([
            'tanggal' => $this->tanggal,
            'kategori' => $this->kategori,
            'supplier_id' => $this->supplier_id,
            'total' => $total,
            'status' => $this->status,
        ]);

        $expense->details()->delete();
        foreach ($this->details as $detail) {
            $expense->details()->create($detail);
        }

        $this->dispatch('success', message: 'Pengeluaran berhasil diperbarui!');
        return $this->redirect(route('admin.expenses.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.expense.expense-form', [
            'suppliers' => Supplier::all()
        ]);
    }
}
