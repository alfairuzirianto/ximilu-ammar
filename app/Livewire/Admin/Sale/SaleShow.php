<?php

namespace App\Livewire\Admin\Sale;

use App\Models\Sale;
use Livewire\Component;

class SaleShow extends Component
{
    public $sale;

    public function mount($id)
    {
        $this->sale = Sale::with('details.product')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.sale.sale-show');
    }
}
