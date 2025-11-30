<?php

namespace App\Livewire\Admin\Expense;

use App\Models\Expense;
use App\Models\Payment;
use Livewire\Component;

class ExpenseShow extends Component
{
    public $expense;
    public $showPaymentModal = false;
    public $tanggal, $nominal, $metode, $catatan;

    public function mount($id)
    {
        $this->expense = Expense::with(['details.supplierItem', 'payments', 'supplier'])->findOrFail($id);
        $this->tanggal = date('Y-m-d');
    }

    public function openPaymentModal()
    {
        $this->showPaymentModal = true;
        $this->reset(['tanggal', 'nominal', 'metode', 'catatan']);
        $this->tanggal = date('Y-m-d');
        $this->nominal = $this->expense->sisaTagihan();
    }

    public function savePayment()
    {
        $validated = $this->validate([
            'tanggal' => 'required|date',
            'nominal' => 'required|numeric|min:0|max:' . $this->expense->sisaTagihan(),
            'metode' => 'required|in:' . implode(',', Payment::METODE),
            'catatan' => 'nullable|string',
        ]);

        $this->expense->payments()->create($validated);

        if ($this->expense->isLunas()) {
            $this->expense->update(['status' => 'lunas']);
        }

        $this->showPaymentModal = false;
        $this->dispatch('success', message: 'Pembayaran berhasil dicatat!');
        $this->mount($this->expense->id);
    }

    public function render()
    {
        return view('livewire.admin.expense.expense-show');
    }
}
