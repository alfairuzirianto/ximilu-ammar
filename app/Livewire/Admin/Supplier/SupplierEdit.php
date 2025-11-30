<?php

namespace App\Livewire\Admin\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class SupplierEdit extends Component
{
    public $supplierId, $nama, $telepon, $email, $alamat;

    public function mount($id)
    {
        $supplier = Supplier::findOrFail($id);
        $this->supplierId = $supplier->id;
        $this->nama = $supplier->nama;
        $this->telepon = $supplier->telepon;
        $this->email = $supplier->email;
        $this->alamat = $supplier->alamat;
    }

    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email',
            'alamat' => 'required|string',
        ];
    }

    public function update()
    {
        Supplier::find($this->supplierId)->update($this->validate());
        $this->dispatch('success', message: 'Pemasok berhasil diperbarui!');
        return $this->redirect(route('admin.suppliers.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.supplier.supplier-form');
    }
}
