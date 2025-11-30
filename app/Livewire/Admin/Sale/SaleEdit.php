<?php

namespace App\Livewire\Admin\Sale;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;

class SaleEdit extends Component
{
    public $saleId, $kode_invoice, $tanggal, $metode;
    public $details = [];

    public function mount($id)
    {
        $sale = Sale::with('details')->findOrFail($id);
        $this->saleId = $sale->id;
        $this->kode_invoice = $sale->kode_invoice;
        $this->tanggal = $sale->tanggal->format('Y-m-d');
        $this->metode = $sale->metode;
        
        foreach ($sale->details as $detail) {
            $this->details[] = [
                'product_id' => $detail->product_id,
                'jumlah' => $detail->jumlah,
                'subtotal' => $detail->subtotal,
            ];
        }
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

    public function update()
    {
        $this->validate([
            'tanggal' => 'required|date',
            'metode' => 'required',
            'details.*.product_id' => 'required',
            'details.*.jumlah' => 'required|integer|min:1',
        ]);

        $total = collect($this->details)->sum('subtotal');

        $sale = Sale::find($this->saleId);
        $sale->update([
            'tanggal' => $this->tanggal,
            'total' => $total,
            'metode' => $this->metode
        ]);

        $sale->details()->delete();
        foreach ($this->details as $detail) {
            $sale->details()->create($detail);
        }

        $this->dispatch('success', message: 'Penjualan berhasil diperbarui!');
        return $this->redirect(route('admin.sales.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.sale.sale-form', [
            'products' => Product::all()
        ]);
    }
}
