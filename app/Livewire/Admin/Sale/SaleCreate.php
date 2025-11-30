<?php

namespace App\Livewire\Admin\Sale;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Str;
use Livewire\Component;

class SaleCreate extends Component
{
    public $kode_invoice, $tanggal, $metode = 'Tunai';
    public $details = [];

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->kode_invoice = 'SAL-' . date('Ymd') . '-' . Str::upper(Str::random(4));
        $this->addDetail();
    }

    public function addDetail()
    {
        $this->details[] = ['product_id' => '', 'jumlah' => 1, 'subtotal' => 0];
    }

    public function removeDetail($index)
    {
        unset($this->details[$index]);
        $this->details = array_values($this->details);
    }

    public function calculateSubtotal($index)
    {
        $detail = $this->details[$index];
        if ($detail['product_id']) {
            $product = Product::find($detail['product_id']);
            $this->details[$index]['subtotal'] = $product->harga_satuan * $detail['jumlah'];
        }
    }

    public function save()
    {
        $this->validate([
            'kode_invoice' => 'required|unique:sales',
            'tanggal' => 'required|date',
            'metode' => 'required',
            'details.*.product_id' => 'required',
            'details.*.jumlah' => 'required|integer|min:1',
        ]);

        $total = collect($this->details)->sum('subtotal');

        $sale = Sale::create([
            'kode_invoice' => $this->kode_invoice,
            'tanggal' => $this->tanggal,
            'metode' => $this->metode,
            'total' => $total,
        ]);

        foreach ($this->details as $detail) {
            $sale->details()->create($detail);
        }

        $this->dispatch('success', message: 'Penjualan berhasil ditambahkan!');
        return $this->redirect(route('admin.sales.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.sale.sale-form', [
            'products' => Product::all()
        ]);
    }
}
