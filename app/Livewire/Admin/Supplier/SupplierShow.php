<?php

namespace App\Livewire\Admin\Supplier;

use App\Models\Supplier;
use App\Models\SupplierItem;
use Livewire\Component;

class SupplierShow extends Component
{
    public $supplier;
    public $showItemModal = false;
    public $itemId, $nama, $satuan, $harga_satuan;

    public function mount($id)
    {
        $this->supplier = Supplier::findOrFail($id);
    }

    public function openItemModal($id = null)
    {
        $this->showItemModal = true;
        if ($id) {
            $item = SupplierItem::find($id);
            $this->itemId = $item->id;
            $this->nama = $item->nama;
            $this->satuan = $item->satuan;
            $this->harga_satuan = $item->harga_satuan;
        } else {
            $this->reset(['itemId', 'nama', 'satuan', 'harga_satuan']);
        }
    }

    public function saveItem()
    {
        $validated = $this->validate([
            'nama' => 'required|string|max:255',
            'satuan' => 'required|in:' . implode(',', SupplierItem::SATUAN),
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        if ($this->itemId) {
            SupplierItem::find($this->itemId)->update($validated);
            $msg = 'Item berhasil diupdate!';
        } else {
            $this->supplier->items()->create($validated);
            $msg = 'Item berhasil ditambahkan!';
        }

        $this->showItemModal = false;
        $this->dispatch('success', message: $msg);
    }

    public function deleteItem($id)
    {
        SupplierItem::find($id)?->delete();
        $this->dispatch('success', message: 'Item berhasil dihapus!');
    }

    public function render()
    {
        return view('livewire.admin.supplier.supplier-show', [
            'items' => $this->supplier->items,
            'units' => SupplierItem::SATUAN,
            'expenses' => $this->supplier->expenses()
                ->where('kategori', 'Pembelian Bahan')
                ->with('payments')
                ->latest()
                ->take(10)
                ->get()
        ]);
    }
}
