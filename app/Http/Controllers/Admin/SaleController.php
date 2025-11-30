<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function invoicePdf($id)
    {
        $sale = Sale::with('details.product')->findOrFail($id);
        
        $pdf = Pdf::loadView('pdf.sale-invoice', ['sale' => $sale])
            ->setPaper('a4', 'portrait');
            
        return $pdf->stream("invoice-{$sale->kode_invoice}.pdf");
    }
}
