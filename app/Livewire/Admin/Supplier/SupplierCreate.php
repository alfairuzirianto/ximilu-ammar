<?php

namespace App\Livewire\Admin\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class SupplierCreate extends Component
{
    public $nama, $telepon, $email, $alamat;

    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email',
            'alamat' => 'required|string',
        ];
    }

    public function save()
    {
        Supplier::create($this->validate());
        $this->dispatch('success', message: 'Pemasok berhasil ditambahkan!');
        return $this->redirect(route('admin.suppliers.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.supplier.supplier-form');
    }
}
