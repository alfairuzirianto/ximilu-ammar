<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function invoicePdf($id)
    {
        $expense = Expense::with(['details.supplierItem', 'supplier', 'payments'])->findOrFail($id);
        
        $pdf = Pdf::loadView('pdf.expense-invoice', ['expense' => $expense])
            ->setPaper('a4', 'portrait');
            
        return $pdf->stream("invoice-{$expense->kode_invoice}.pdf");
    }
}
