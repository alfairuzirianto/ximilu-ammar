<?php

namespace App\Livewire\Admin\Expense;

use App\Models\Expense;
use App\Models\Supplier;
use App\Models\SupplierItem;
use Illuminate\Support\Str;
use Livewire\Component;

class ExpenseCreate extends Component
{
    public $kode_invoice, $tanggal, $kategori, $supplier_id, $status = 'belum lunas';
    public $details = [];
    public $supplierItems = [];

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->kode_invoice = 'EXP-' . date('Ymd') . '-' . Str::upper(Str::random(4));
        $this->addDetail();
        
        if (request('supplier_id')) {
            $this->supplier_id = request('supplier_id');
            $this->kategori = 'Pembelian Bahan';
            $this->loadSupplierItems();
        }
    }

    public function loadSupplierItems()
    {
        if ($this->supplier_id) {
            $this->supplierItems = SupplierItem::where('supplier_id', $this->supplier_id)->get();
        }
    }

    public function addDetail()
    {
        $this->details[] = ['supplier_item_id' => '', 'deskripsi' => '', 'jumlah' => 1, 'harga_satuan' => 0, 'subtotal' => 0];
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
            $this->details[$index]['harga_satuan'] = $item->harga_satuan;
            $this->details[$index]['subtotal'] = $item->harga_satuan * $detail['jumlah'];
        } else {
            // Manual calculation for non-supplier items
            $this->details[$index]['subtotal'] = ($detail['harga_satuan'] ?? 0) * $detail['jumlah'];
        }
    }

    public function save()
    {
        $this->validate([
            'kode_invoice' => 'required|unique:expenses',
            'tanggal' => 'required|date',
            'kategori' => 'required',
            'status' => 'required',
            'details.*.jumlah' => 'required|integer|min:1',
        ]);

        $total = collect($this->details)->sum('subtotal');

        $expense = Expense::create([
            'kode_invoice' => $this->kode_invoice,
            'tanggal' => $this->tanggal,
            'kategori' => $this->kategori,
            'supplier_id' => $this->supplier_id,
            'total' => $total,
            'status' => $this->status,
        ]);

        foreach ($this->details as $detail) {
            $expense->details()->create($detail);
        }

        $this->dispatch('success', message: 'Pengeluaran berhasil ditambahkan!');
        return $this->redirect(route('admin.expenses.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.expense.expense-form', [
            'suppliers' => Supplier::all()
        ]);
    }
}
